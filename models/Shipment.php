<?php namespace Istheweb\Shop\Models;

use Doctrine\Common\Collections\ArrayCollection;

use Model;
use Request;

/**
 * Shipment Model
 */
class Shipment extends Model
{

    // Shipment default states.
    /**
     *
     */
    const STATE_CHECKOUT = 'checkout';
    /**
     *
     */
    const STATE_ONHOLD = 'onhold';
    /**
     *
     */
    const STATE_PENDING = 'pending';
    /**
     *
     */
    const STATE_READY = 'ready';
    /**
     *
     */
    const STATE_BACKORDERED = 'backordered';
    /**
     *
     */
    const STATE_SHIPPED = 'shipped';
    /**
     *
     */
    const STATE_RETURNED = 'returned';
    /**
     *
     */
    const STATE_CANCELLED = 'cancelled';

    /**
     *
     */
    const SHIPMENT_TYPE = 'shipment';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_shipments';

    /**
     * @var array Implements bevaviors
     */
    public $implement = [
        'Istheweb.Shop.Behaviors.ShipmentModel'
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */

    public $hasMany = [
        'shipping_items' => 'Istheweb\Shop\Models\ShipmentItem',
    ];
    /**
     * @var array
     */
    public $belongsTo = [
        'order'             => 'Istheweb\Shop\Models\Order',
        'shipping_method'   => 'Istheweb\Shop\Models\ShippingMethod',
    ];


    /**
     * @param ShipmentItem $unit
     * @return mixed
     */
    public function hasUnit(ShipmentItem $unit){
        return $this->shipping_items->contains($unit);
    }

    /**
     * {@inheritdoc}
     */
    public function isTracked()
    {
        return null !== $this->tracking;
    }

    /**
     *
     */
    public function afterSave()
    {
        self::updateShipmentItems();
    }

    public function scopeShipmentWithItems($query, $order)
    {
        return $query->with('shipping_items')
            ->where('order_id', $order->id)
            ->first();
    }

    /**
     * @return array
     */
    public function getShippingMethodOptions()
    {
        if(!is_null($this->order)){
            return self::getMethods($this->order);
        }else{
           $id = Request::segment(6);
           $order = Order::with('order_items')->find($id);
           return self::getMethods($order);
        }
    }

    public function shipmentItemsCount()
    {
        $count = 0;
        if(!is_null($this->shipment_items)){
            $count = $this->shipment_items->count();
        }
        return $count;
    }

    /**
     * @param $is_order
     */
    public function updateShipmentItems($is_order = false)
    {
        $products = self::getProductables($this->order);
        //$shipment_items = ShipmentItem::shipmentItemsByShipment($this);
        self::deleteShippingItems();
        if(is_array($products) && count($products) > 0){
            foreach($products as $product){
                self::addShippingItem($product['id'], $product['type']);
            }
        }

        if(!$is_order){
            $this->order->checkAdjustments();
        }
    }

    /**
     * @return mixed
     */
    public function calculateShipment()
    {
        $total = 0;
        $method = ShippingMethod::find($this->shipping_method->id);

        if($method->calculator == 'flat_rate'){
            $total = $this->shipping_method->amount;
        }elseif($method->calculator == 'per_unit_rate'){
            $order = Order::find($this->order_id);
            $total = $method->amount * OrderItem::orderCountItems($order);
        }
        $amounts = explode( '.', $total);
        if(count($amounts) == 2){
            $amount1 = strlen($amounts[1]) == 2 ? $amounts[1] : $amounts[1].'0';
            $amount = $amounts[0]."".$amount1;
        }else{
            $amount = $total."00";
        }
        return $amount;
    }

    /**
     * @param $order
     * @return array
     */
    protected function getMethods($order)
    {
        $products = self::getProductables($order, true);
        if(count($products) > 0){
            $methods = ShippingMethod::whereIn('shipping_category_id', $products)->lists('name', 'id');
            return $methods;
        }else{
            return ['' => '-- Tienes que añadir elementos al pedido --'];
        }
    }

    /**
     * @param $order
     * @param $is_cat
     * @return array
     */
    protected function getProductables($order, $is_cat = false)
    {
        $products = array();
        if(!$order->order_items->isEmpty()){
            foreach($order->order_items as $order_item)
            {
                $item = $order_item->productable;
                if(!$is_cat) {
                    array_push($products, ['id' => $item->id, 'type' => get_class($item)]);
                }else{
                    if(get_class($item) == 'Istheweb\Shop\Models\Variant'){
                        array_push($products, $item->product->shipping_category->id);
                    }else{
                        array_push($products, $item->shipping_category->id);
                    }
                }
            }
        }
        return $products;
    }

    /**
     * @param $id
     * @param $type
     */
    protected function addShippingItem($id, $type)
    {
        $item = new ShipmentItem();
        $item->shipment = $this;
        $item->shippable_id = $id;
        $item->shippable_type = $type;
        $item->state = self::STATE_READY;
        $item->save();
        $this->shipping_items()->add($item);
    }

    protected function deleteShippingItems()
    {
        $shipment_items = ShipmentItem::shipmentItemsByShipment($this);
        foreach($shipment_items as $item){
            $item->delete();
        }
    }
}
