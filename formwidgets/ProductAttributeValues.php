<?php namespace Istheweb\Shop\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Backend\FormWidgets\DatePicker;
use Istheweb\Shop\Models\Attribute;
use System\Helpers\DateTime as DateTimeHelper;

/**
 * ProductAttributeValues Form Widget
 */
class ProductAttributeValues extends FormWidgetBase
{

    public $datePicker;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'istheweb_shop_product_attribute_values';

    public function __construct($controller, $formField, $configuration = [])
    {
        parent::__construct($controller, $formField, $configuration);
        $this->datePicker = $this->makeFormWidget(DatePicker::class, $formField, $configuration);
    }

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
        return $this->makePartial('productattributevalues');
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
        $this->vars['attributes'] = $this->getAttributes();
        $this->vars['isModel'] = $this->model->id ? true : false;


        if(isset($this->model->id)){
            $attribute = $this->getAttribute($this->model->attribute_id);
            $type = $attribute->type . "_value";
            $attribute->value = $this->model->{$type};
            $this->vars['attribute'] = $attribute;
            if($attribute->type == 'date' || $attribute->type == 'datetime'){
                $this->datePicker->mode = $attribute->type;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/productattributevalues.css', 'Istheweb.Shop');
        $this->addJs('js/productattributevalues.js', 'Istheweb.Shop');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {

        //$attr = Attribute::find(post('attributes'));

        /**
         * *************************************************
         * TODO: Ahora el valor de texto no es traducible.
         * PENDIENTE DE ACCTUALIZAR
         * *************************************************
         */

        $postAttrValues = post('AttributeValue');

        if(is_array($postAttrValues)){
            $value = $postAttrValues['model'];
        }else{
            $value = post('value');
        }
        //dd($this->model);

        return  $value;
    }

    public function onAttributesChange()
    {
        $attribute = $this->getAttribute(post('attributes'));
        $this->vars['attribute'] = $attribute;
        if($attribute->type == 'date' || $attribute->type == 'datetime'){
            $this->datePicker->mode = $attribute->type;
        }
        return [
            "#item" => $this->makePartial('item')
        ];
    }

    protected function getAttributes()
    {
        return Attribute::getAllAtributes();
    }

    protected function getAttribute($id)
    {
        return Attribute::find($id);
    }
}
