<?php namespace Istheweb\Shop\Models;

use Model;

/**
 * Channel Model
 */
class Channel extends Base
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_channels';

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
    public $hasOne = [];
    public $hasMany = [
        'products' => 'Istheweb\Shop\Models\Product',
    ];
    public $belongsTo = [
        'default_locale' => 'RainLab\Translate\Models\Locale',
        'base_currency'  => 'Istheweb\Shop\Models\Currency',
        'tax_zone'       => 'Istheweb\Shop\Models\TaxRate'
    ];

}
