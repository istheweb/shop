<?php namespace Istheweb\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Istheweb\Shop\Models\Order;

/**
 * Orders Back-end Controller
 */
class Orders extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
        'Istheweb.Shop.Behaviors.OrderController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Shop', 'shop', 'orders');

        $this->addCss('/plugins/istheweb/shop/assets/css/shop.css');
    }

    public function update($recordId, $context = null)
    {
        //$base_totals = Order::getBaseTotals($recordId);
        return $this->asExtension('FormController')->update($recordId, $context);
    }

}