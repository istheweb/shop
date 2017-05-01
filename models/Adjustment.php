<?php namespace Istheweb\Shop\Models;

use Model;

/**
 * Adjustment Model
 */
class Adjustment extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_adjustments';

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
    public $morphTo = [
        'orderable' => []
    ];

    public function scopeFindByTaxOrderable($query, $orderable)
    {
        return $query->where("orderable_id", $orderable->id)
            ->where('orderable_type', get_class($orderable))
            ->where('type', TaxRate::TAX_TYPE);
    }

    public function scopeFindByShipping($query, $orderable)
    {
        return $query->where('orderable_id', $orderable->id)
            ->where('orderable_type', get_class($orderable))
            ->where('type', Shipment::SHIPMENT_TYPE);
    }

    public function scopeSumAdjustment($query, $orderable, $type)
    {
        return $query->where("orderable_id", $orderable->id)
            ->where('orderable_type', get_class($orderable))
            ->where('type', $type)
            ->sum('amount');
    }

}