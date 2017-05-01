<?php namespace Istheweb\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Istheweb\Shop\Models\Attribute;
use Istheweb\Shop\Models\AttributeValue;
use Istheweb\Shop\Models\OptionValue;
use Istheweb\Shop\Models\Product;
use Istheweb\Shop\Models\Variant;
use October\Rain\Support\Facades\Flash;

/**
 * Products Back-end Controller
 */
class Products extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',

    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {

        parent::__construct();
        //$this->vars['attributes'] = Attribute::getAllAtributes();

        BackendMenu::setContext('Istheweb.Shop', 'shop', 'products');
    }
}