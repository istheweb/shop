<?php namespace Istheweb\Shop\Models;

use Illuminate\Support\Facades\Lang;
use istheweb\shop\classes\ShippableInterface;
use istheweb\shop\classes\ShippingCategoryInterface;
use istheweb\shop\classes\StockableInterface;


/**
 * Product Model
 */
class Product extends Base implements StockableInterface, ShippableInterface
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_products';

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name'];

    //protected $jsonable = ['att_values'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'attributeValues'           => 'Istheweb\Shop\Models\AttributeValue',
        'variants'                  => 'Istheweb\Shop\Models\Variant'
    ];
    public $belongsTo = [
        'channel'               => 'Istheweb\Shop\Models\Channel',
        'tax_category'          => 'Istheweb\Shop\Models\TaxCategory',
        'shipping_category'     => 'Istheweb\Shop\Models\ShippingCategory',
    ];
    public $belongsToMany = [
        'options' => ['Istheweb\Shop\Models\Option',
            'table' => 'istheweb_shop_pivots',
        ],
        'categories' => ['Istheweb\Shop\Models\Category',
            'table' => 'istheweb_shop_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [
        'order_items'       => ['Istheweb\Shop\Models\OrderItem', 'name' => 'productable'],
        'shipping_items'    => ['Istheweb\Shop\Models\ShippingItem', 'name' => 'shippable'],
        'inventory_units'   => ['Istheweb\Shop\Models\InventoryUnit', 'name' => 'stockable'],
    ];
    public $attachOne = [];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
    ];

    public function afterDelete(){
        if($this->order_items()) $this->order_items()->detach();
        if($this->shipping_items()) $this->shipping_items()->detach();
    }

    public function getProductTypeOptions(){
        return [
            1 => Lang::get('istheweb.shop::lang.product.simple'),
            2 => Lang::get('istheweb.shop::lang.product.compound'),
            3 => Lang::get('istheweb.shop::lang.product.virtual'),
        ];
    }

    public function filterFields($fields, $context = null){
        if($fields->product_type->value == 2){
            $fields->options_section->hidden = false;
            $fields->options->hidden = false;
            $fields->variants_section->hidden = false;
            if($context == 'update') {
                $fields->variants->hidden = false;
            }
        }else{
            $fields->options_section->hidden = true;
            $fields->options->hidden = true;
            $fields->variants_section->hidden = true;
            if($context == 'update'){
                $fields->variants->hidden = true;
            }
        }
    }

    public static function getAttributeIdOptions()
    {
        $attributes = Attribute::getAllAtributes();
        return $attributes;
    }

    public function isStockable()
    {
        return $this->tracked;
    }

    public function getTaxRate()
    {
        $tax_rate = TaxRate::rate($this->tax_category_id)->first();
        return $tax_rate;
    }

    public function getInventoryName()
    {
        return $this->name;
    }

    public function isInStock()
    {
        return 0 < $this->onHand;
    }

    public function isAvailableOnDemand()
    {
        // TODO: Implement isAvailableOnDemand() method.
    }

    public function getOnHold()
    {
        return $this->on_hold;
    }

    public function setOnHold($onHold)
    {
        $this->on_hold = $onHold;
    }

    public function getOnHand()
    {
        return $this->on_hand;
    }

    public function setOnHand($onHand)
    {
        $this->on_hand = $onHand;
    }

    public function setTracked($tracked)
    {
        $this->tracked = $tracked;
    }

    public function isTracked()
    {
        return $this->tracked;
    }

    public function getShippingWeight()
    {
        return $this->weight;
    }

    public function getShippingVolume()
    {
        return $this->volume;
    }

    public function getShippingWidth()
    {
        return $this->width;
    }

    public function getShippingHeight()
    {
        return $this->height;
    }

    public function getShippingDepth()
    {
        return $this->depth;
    }

    public function getShippingCategory()
    {
        return $this->shipping_category;
    }


}