<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * ShippingMethod Model
 */
class ShippingMethod extends Base
{
    use Validation;



    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_shipping_methods';

    /**
     * @var array Validation rules
     */
    protected $rules = [
        'code'  => 'required|unique:istheweb_shop_shipping_methods|max:255',
        'name'  => 'required|max:255',
        'zone'  => 'required',
        'calculator' => 'required',
        'amount' => 'required|numeric'
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'code',
        'name',
        'amount',
        'calculator',
    ];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'zone'                  => 'Istheweb\Shop\Models\Zone',
        'shipping_category'     => 'Istheweb\Shop\Models\ShippingCategory',
        'tax_category'          => 'Istheweb\Shop\Models\TaxCategory',
    ];
}