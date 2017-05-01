<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * ShippingCategory Model
 */
class ShippingCategory extends Base
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_shipping_categories';

    /**
     * @var array Validation rules
     */
    protected $rules = [
        'code'      => 'required|unique:istheweb_shop_shipping_categories',
        'name'      => 'required|max:255',
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'shipping_methods' => 'Istheweb\Shop\Models\ShippingMethod',
    ];
    public $belongsTo = [];
}