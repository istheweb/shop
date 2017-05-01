<?php namespace Istheweb\Shop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Attributes Back-end Controller
 */
class Attributes extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Istheweb.Shop', 'shop', 'attributes');
    }
}