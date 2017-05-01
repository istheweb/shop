<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * PaymentMethod Model
 */
class PaymentMethod extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_payment_methods';

    /*
     * Validation
     */
    public $rules = [

        'code' => [
            'required',
            'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i',
            'unique:istheweb_shop_payment_method'
        ],
        'getaway' => 'required'
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
     * @var array Jsonable fields
     */
    protected $jsonable = ['environment'];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'payments'          => 'Istheweb\Shop\Models\Payement'
    ];

}
