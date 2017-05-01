<?php namespace Istheweb\Shop\Models;

use istheweb\shop\classes\OrderCheckoutTransitions;
use Model;
use Request;
use October\Rain\Database\Traits\Purgeable;
use RainLab\Translate\Classes\Translator;
use October\Rain\Database\Traits\Validation;
use StateMachine;


/**
 * Order Model
 */
class Order extends Model
{
    use Validation, Purgeable;

    const STATE_NEW = 'new';
    const STATE_CART = 'cart';
    const STATE_CART_LOCKED = 'cart_locked';
    const STATE_PENDING = 'pending';
    const STATE_CONFIRMED = 'confirmed';
    const STATE_SHIPPED = 'shipped';
    const STATE_ABANDONED = 'abandoned';
    const STATE_CANCELLED = 'cancelled';
    const STATE_RETURNED = 'returned';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_orders';

    /**
     * @var array Implements bevaviors
     */
    public $implement = [
        'Istheweb.Shop.Behaviors.OrderModel'
    ];

    public $purgeable = [
        'currencies'
    ];

    /**
     * @var array Guarded fields
     */
    protected $rules = [
        'reference' => 'unique:istheweb_shop_orders'
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'reference',
    ];

    /**
     * @var array Relations
     */

    public $hasOne = [
       'shipment'      => 'Istheweb\Shop\Models\Shipment'
    ];

    public $belongsTo = [
        //'order_status'      => 'Istheweb\Shop\Models\OrderStatus',
        'channel'           => ['Istheweb\Shop\Models\Channel'],
        'customer'          => ['Istheweb\Shop\Models\Customer'],
        'shipping_address'  => ['Istheweb\Shop\Models\Address'],
        'billing_address'   => ['Istheweb\Shop\Models\Address'],
    ];

    public $hasMany = [
        'order_items'           => [ 'Istheweb\Shop\Models\OrderItem'],
    ];

    public $morphMany = [
        'adjustments'      => ['Istheweb\Shop\Models\Adjustment', 'name' => 'orderable']
    ];

    public function getPaymentMethodOptions(){
        $shop = ShopSettings::instance();
        $payment_methods = $shop->getPaymentMethodOptions();
        return $payment_methods;
    }

    public function getCurrenciesOptions()
    {
        $currencies = Currency::active()->lists('name', 'id');;
        return $currencies;
    }

    public function beforeCreate()
    {
        $order = post('Order');

        $this->reference = self::formatReference();
        $this->customer_ip = Request::getClientIp();
        $translator = Translator::instance();
        $this->locale_code = $translator->getLocale();

        $currency = Currency::find($order['currencies']);
        if(!is_null($currency)){
            $this->currency_code = $currency->iso_code;
        }
    }

    public function beforeSave()
    {

    }

    public function afterCreate()
    {
        $order = Order::find($this->id);
        $stateMachine = StateMachine::get($order, OrderCheckoutTransitions::GRAPH);

        if($stateMachine->can(OrderCheckoutTransitions::TRANSITION_ADDRESS)){
            $stateMachine->apply(OrderCheckoutTransitions::TRANSITION_ADDRESS);
        }
    }

    public function scopeLastReference($query){
        $query->select('reference')->orderBy('id', 'desc');
    }

    public function hasShipment()
    {
        return $this->shipment ? true : false;
    }

}