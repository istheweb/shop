<?php namespace Istheweb\Shop\Models;


use Model;
use October\Rain\Database\Traits\Validation;

/**
 * OrderItem Model
 */
class OrderItem extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_order_items';

    /**
     * @var array Implements bevaviors
     */
    public $implement = [
        'Istheweb.Shop.Behaviors.OrderItemModel'
    ];

    /**
     * @var array Validation rules
     */
    protected $rules = [
        'quantity' => 'required',
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'quantity',
        'unit_price',
        'unit_total',
        'total',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'order'     => 'Istheweb\Shop\Models\Order',
    ];

    public $morphTo = [
         'productable' => []
    ];

    public $morphMany = [
        'adjustments'      => ['Istheweb\Shop\Models\Adjustment', 'name' => 'orderable']
    ];

    public function beforeSave()
    {
        $this->getTotalItem();

    }

    public function afterSave()
    {
        $this->checkAdjustement();
    }

    public function beforeDelete()
    {
        $this->removeAdjustment();
    }

    public function afterDelete()
    {
        Order::updateAdjustment(TaxRate::TAX_TYPE);
    }

    public function scopeOrderCountItems($query,$order)
    {
        return $query->where('order_id', $order->id)->sum('quantity');
    }
}