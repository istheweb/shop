<?php namespace Istheweb\Shop\Models;


use October\Rain\Database\Traits\Validation;
use System\Models\MailTemplate;

/**
 * OrderStatus Model
 */
class OrderStatus extends Base
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_order_statuses';

    /**
     * @var array Guarded fields
     */
    protected $rules = [
        'state' => 'required|max:20',
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'state',
        'color',
        'send_email',
        'attach_invoice',
        'email_template',
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'orders' => 'Istheweb\Shop\Models\Order',
    ];

    public function getEmailTemplateOptions()
    {
        return MailTemplate::listAllTemplates();
    }


}