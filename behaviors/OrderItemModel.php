<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 5/02/17
 * Time: 10:01
 */

namespace istheweb\shop\behaviors;


use istheweb\shop\classes\AvailabilityChecker;
use Istheweb\Shop\Models\Adjustment;
use Istheweb\Shop\Models\InventoryUnit;
use Istheweb\Shop\Models\OrderItem;
use Istheweb\Shop\Models\TaxRate;
use System\Classes\ModelBehavior;

/**
 * Class OrderItemModel
 * @package istheweb\shop\behaviors
 */
class OrderItemModel extends ModelBehavior
{

    public $tax_adjustment;

    public function __construct( $model )
    {
        parent::__construct($model);
    }


    /**
     *
     */
    public function getTotalItem()
    {
        $id = post('OrderItem[productable]');
        $quantity = post('OrderItem[quantity]');

        $className = $this->model->productable_type;
        $instance = new $className;
        $item = $instance->find($id)->first();

        $availabilityChecker = new AvailabilityChecker(false);

        if($item->isTracked()){
            /**
             * TODO: It does not work
             */
            if($availabilityChecker->isStockSufficient($item, $quantity)){
                $inventoryUnit = new InventoryUnit();
                $inventoryUnit->hold($item, $quantity);
            }else{
                /**
                 * TODO: Implement not sufficient Stock response
                 */
            }
        }
        $this->model->unit_price = $item->price;
        $this->model->unit_total = $item->price * $quantity;
        $this->model->total = $this->model->unit_total;

    }

    /**
     * Check if exists adjustment for OrderItem
     * If null add new tax adjustment, else update existing
     *
     */
    public function checkAdjustement()
    {
        $adjustment = Adjustment::findByTaxOrderable($this->model)->first();


        if(is_null($adjustment)){
            $this->addAdjustment();
        }else{
            $this->updateAdjustment($adjustment);
        }
    }

    /**
     * @param $id
     * @param $type
     * @return mixed
     */
    public function getProductable($id, $type)
    {
        $instance = new $type;
        $item = $instance->find($id);
        return $item;
    }

    /**
     *
     */
    public function addAdjustment()
    {
        $tax_rate = $this->model->productable->getTaxRate();
        $rate = $tax_rate->calculate($this->model->total);
        $adjustment = new Adjustment();
        $adjustment->orderable_id = $this->model->id;
        $adjustment->orderable_type = get_class($this->model);
        $adjustment->type = TaxRate::TAX_TYPE;
        $adjustment->name = $tax_rate->name;
        $adjustment->amount = (int)$rate;
        $adjustment->is_neutral = TaxRate::isIncludedInPrice();
        $adjustment->is_locked = false;
        $adjustment->save();

        $this->model->order->updateAdjustment(TaxRate::TAX_TYPE);
    }

    /**
     * @param $adjustment
     */
    public function updateAdjustment($adjustment){
        if($adjustment->exists){
            $taxrate = $this->model->productable->getTaxRate();
            $rate = $taxrate->calculate($this->model->total);
            $adjustment->amount = (int) $rate;
            $adjustment->save();
            $this->model->order->updateAdjustment(TaxRate::TAX_TYPE);
        }
    }

    public function removeAdjustment()
    {
        $item = OrderItem::find($this->model->id);
        $adjustment = Adjustment::findByTaxOrderable($item)->first();
        $adjustment->delete();
    }
}