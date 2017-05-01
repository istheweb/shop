<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/02/17
 * Time: 12:59
 */

namespace istheweb\shop\behaviors;


use istheweb\shop\classes\OrderCheckoutTransitions;
use Istheweb\Shop\Models\Adjustment;
use Istheweb\Shop\Models\Order;
use Istheweb\Shop\Models\OrderItem;
use Istheweb\Shop\Models\Shipment;
use Istheweb\Shop\Models\ShippingMethod;
use Istheweb\Shop\Models\ShopSettings;
use Istheweb\Shop\Models\TaxRate;
use PayPal\Api\Tax;
use System\Classes\ModelBehavior;
use Request;
use StateMachine;

/**
 * Class OrderModel
 * @package istheweb\shop\behaviors
 */
class OrderModel extends ModelBehavior
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function process(Order $order)
    {
        $order->save();
    }

    /**
     * Return order reference number from existing ones in datase
     * @return integer reference number
     */
    public function formatReference(){
        $shopSettings = ShopSettings::instance();
        $count = Order::all()->count();

        if($count == 0){
            $reference = $shopSettings->order_reference;
        }else{
            $last = Order::lastReference()->first();
            $reference = $last->reference + 1;
        }
        return $reference;
    }

    /**
     *
     */
    public function updateTotals()
    {
        $base = 0;
        if($this->model->order_items){
            foreach($this->model->order_items as $item){
                $base += $item->total;
            }
        }

        $this->model->subtotal = $base;
        $taxes = Adjustment::sumAdjustment($this->model, TaxRate::TAX_TYPE);
        $this->model->tax = self::formatAdjustemnt($taxes);
        if($this->model->hasShipment()){
            $shipping = Adjustment::sumAdjustment($this->model, Shipment::SHIPMENT_TYPE);
            $this->model->shipping = self::formatAdjustemnt($shipping);

            $state_machine = StateMachine::get($this->model, OrderCheckoutTransitions::GRAPH);
            if($state_machine->can(OrderCheckoutTransitions::TRANSITION_SELECT_SHIPPING)){
                $state_machine->apply(OrderCheckoutTransitions::TRANSITION_SELECT_SHIPPING);
            }
            $this->model->adjustments_total = $taxes + $shipping;
            $this->model->total = $this->model->subtotal + $this->model->tax + $this->model->shipping;
        }else{
            $this->model->adjustments_total = $taxes;
            $this->model->total = $this->model->subtotal + $this->model->tax;
        }
        $this->model->save();
    }

    /**
     *
     */
    public function checkAdjustments()
    {
        $shipment_adjust = Adjustment::findByShipping($this->model)->first();
        if(is_null($shipment_adjust)){
            self::addAdjustment();
        }else{
            $shipment = Shipment::shipmentWithItems($this->model);
            if(!is_null($shipment)){

                if($shipment->shipping_items->count() != $this->model->order_items->count()){
                    $shipment->updateShipmentItems(true);
                }
                $shipment_adjust->amount = $shipment->calculateShipment();
                $shipment_adjust->save();
            }
        }
        self::updateTotals();
    }

    /**
     * @param $type
     * @param null $adjustment
     * @param bool $is_neutral
     * @param bool $is_locked
     */

    public function addAdjustment($adjustment = null){
        $adjust = new Adjustment();
        $adjust->orderable_id = $this->model->id;
        $adjust->orderable_type = get_class($this->model);

        if(!is_null($adjustment)){
            $adjust->type = $adjustment->type;
            $adjust->amount = $adjustment->amount;
            $adjust->name = $adjustment->name;
            $adjust->is_neutral = $adjustment->is_neutral;
            $adjust->is_locked = $adjustment->is_locked;
            $adjust->save();
            self::checkAdjustments();
        }else{
            $method = self::getShippingMethod();
            $shipment = Shipment::shipmentWithItems($this->model);
            if(!is_null($method)){
                $adjust->name = $method->name;
                $adjust->amount = $shipment->calculateShipment();
                $adjust->type = Shipment::SHIPMENT_TYPE;
                $adjust->is_neutral = false;
                $adjust->is_locked = false;
                $adjust->save();
            }
        }
    }

    /**
     * @param $type
     * @param null $amount
     */
    public function updateAdjustment($type)
    {
        $id = $this->model->id;
        if(is_null($id)){
            $id = Request::segment(6);
            $this->model = Order::find($id);
        }
        if($type == TaxRate::TAX_TYPE){
            self::deleteAdjustments();
            $order_items = OrderItem::where('order_id', $id)->get();
            foreach($order_items as $item){
                $adjustment = Adjustment::findByTaxOrderable($item)
                    ->first();
                self::addAdjustment($adjustment);
            }
        }
    }

    /**
     * @return int
     */
    public function calculateAdjustments()
    {
        $total = 0;
        $adjustments = Adjustment::findByTaxOrderable($this->model)->get();
        foreach($adjustments as $adjustment)
        {
            $total += $adjustment->amount;
        }

        return $total;
    }

    /**
     * @param $adjustment
     * @return string
     */
    protected function formatAdjustemnt($adjustment)
    {
        return number_format(($adjustment/100), 2);
    }

    protected function deleteAdjustments()
    {
        $adjustments = Adjustment::FindByTaxOrderable($this->model)->get();
        foreach($adjustments as $adjustment)
        {
            $adjustment->delete();
        }
    }

    /**
     * @return mixed
     */
    protected function getShippingMethod()
    {
        $shipment = $this->model->shipment;
        $method = null;
        if(!is_null($shipment)){
            $id = $shipment->shipping_method_id;
            $method = ShippingMethod::find($id);
        }else{
            $shipment = Shipment::where('order_id', $this->model->id)->first();
            if(!is_null($shipment)){
                $method = ShippingMethod::find($shipment->shipping_method_id);
            }
        }
        return $method;
    }


}