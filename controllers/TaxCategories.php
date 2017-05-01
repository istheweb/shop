<?php namespace Istheweb\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Tax Categories Back-end Controller
 */
class TaxCategories extends Controller
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

        BackendMenu::setContext('Istheweb.Shop', 'shop', 'taxcategories');
    }
}