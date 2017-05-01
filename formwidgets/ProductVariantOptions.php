<?php namespace Istheweb\Shop\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Istheweb\Shop\Models\OptionValue;
use Istheweb\Shop\Models\Variant;

/**
 * ProductVariantOptions Form Widget
 */
class ProductVariantOptions extends FormWidgetBase
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'istheweb_shop_product_variant_options';

    /**
     * {@inheritDoc}
     */
    protected $product;

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
        return $this->makePartial('productvariantoptions');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;

        $this->product = $this->vars['product'] = $this->controller->vars['formModel'];

        $this->vars['options'] = $this->getOptions();
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/productvariantoptions.css', 'Istheweb.Shop');
        $this->addJs('js/productvariantoptions.js', 'Istheweb.Shop');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        if(is_array($value)){
            $arr = array();
            foreach ($value as $k => $v){
                $option = OptionValue::find($v);
                $arr[] = $option;
            }
        }
        return $arr ?: null;
    }

    protected function getVariants()
    {
        return $this->controller->vars['formModel'];
    }

    protected function getOptions()
    {
        $options = $this->product->options;

        $arr = array();
        if(count($this->model->attributes) > 0){
            $variant = Variant::with('optionsValues')->find($this->model->id);
            foreach($variant->optionsValues as $option){
                $arr[] = $option->id;
            }
        }

        $this->vars['variants'] = $arr;

        $option_values = array();
        foreach($options as $option){
            $values = OptionValue::where('option_id', $option->id)->get();
            $items['name'] = $option->name;
            $items['code'] = $option->code;
            $items['option_value_id'] = $option->id;
            $items['optionValues'] = $values;
            $option_values[] = $items;
        }

        return $option_values;
    }

}
