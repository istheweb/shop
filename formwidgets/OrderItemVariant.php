<?php namespace Istheweb\Shop\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Istheweb\Shop\Models\Product;
use Istheweb\Shop\Models\Variant;

/**
 * OrderItemVariant Form Widget
 */
class OrderItemVariant extends FormWidgetBase
{
    use \Backend\Traits\FormModelWidget;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'istheweb_shop_order_item_variant';

    /**
     * @var Model Relationship model
     */
    public $relationModel;

    public $productable_type;

    /**
     * {@inheritDoc}
     */
    public function init()
    {

    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('orderitemvariant');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->relationModel = $this->getRelationModel();

        $this->vars['name'] = $this->formField->getName();
        //dd($this->vars['name']);
        $this->vars['value'] = $this->getLoadValue();

        $this->vars['type'] = $this->productable_type;
        $this->vars['model'] = $this->model;

        $this->vars['variants'] = $this->getVariants();
        $this->vars['products'] = $this->getProducts();
    }

    /**
     * TODO: Tenemos que comprobar existencias de productos
     * y variantes para mostras sólo aquellos que tenemos en inventario.
     * OJO: Comprobar tanto en variantes como en productos
     */
    protected function getVariants(){

        $variants = Variant::all()->lists('id', 'name');
        return $variants;
    }

    protected function getProducts()
    {
        $products = Product::where('product_type', '=', 1)->lists('id', 'name');
        return $products;
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/orderitemvariant.css', 'Istheweb.Shop');
        $this->addJs('js/orderitemvariant.js', 'Istheweb.Shop');
    }

    public function getLoadValue()
    {

        if(!is_null($this->model->productable_id)){
            $this->productable_type = $this->model->productable_type;
            return $this->model->productable_id;
        }else{
            $this->productable_type = null;
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        if(post('productable_type') == 'variants'){
            $class = 'Istheweb\Shop\Models\Variant';
        }else{
            $class = 'Istheweb\Shop\Models\Product';
        }
        $this->model->productable_type = $class;

        return $value;
    }

}
