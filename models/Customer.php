<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Customer Model
 */
class Customer extends Model
{
    use Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_customers';

    /**
     * @var array
     */
    public $implement = [
        'Istheweb.Shop.Behaviors.CustomerModel'
    ];

    /**
     *
     * @var array Validation rules
     */
    protected $rules = [
    ];



    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'user',
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'addresses' => 'Istheweb\Shop\Models\Address',
        'orders'    => 'Istheweb\Shop\Models\Order',
    ];
    public $belongsTo = [
        'user' => 'RainLab\User\Models\User',
    ];



    public function beforeSave()
    {
        //dd(post());
    }

}