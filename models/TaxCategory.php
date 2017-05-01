<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * TaxCategory Model
 */
class TaxCategory extends Base
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_tax_categories';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    protected $rules = [
        'name' => 'required|max:255',
        'code' => 'required'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'tax_rates' => 'Istheweb\Shop\Models\TaxRate',
    ];

}