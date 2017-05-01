<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Payment Model
 */
class Payment extends Model
{
    use Validation;
    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_payments';

    public $rules = [
       'currency_code'      => 'required',
        'amount'            => 'required|integer',
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
    public $belongsTo = [
        'order'             => 'Istheweb\Shop\Models\Order',
        'payment_method'    => 'Istheweb\Shop\Models\PaymentMethod',
    ];
}
