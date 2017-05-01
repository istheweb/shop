<?php namespace Istheweb\Shop\Models;

use istheweb\shop\classes\StockableInterface;
use Request;
use Sylius\Component\Inventory\Checker\AvailabilityCheckerInterface;
use Sylius\Component\Product\Model\DateRange;


/**
 * Variant Model
 */
class Variant extends Base implements StockableInterface
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_variants';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'code',
        'name',
        'availableOn',
        'pricing_calculator',
        'price',
        'on_hand',
        'tracked',
    ];

    /**
     * @var array Relations
     */

    public $belongsTo = [
        'product'       => 'Istheweb\Shop\Models\Product'
    ];
    public $belongsToMany = [
        'optionsValues' => ['Istheweb\Shop\Models\OptionValue',
            'table' => 'istheweb_shop_pivots',
        ]
    ];

    public $morphMany = [
        'order_items'      => ['Istheweb\Shop\Models\OrderItem', 'name' => 'productable'],
        'shipping_items'    => ['Istheweb\Shop\Models\ShippingItem', 'name' => 'shippable'],
        'inventory_units'   => ['Istheweb\Shop\Models\InventoryUnit', 'name' => 'stockable'],
    ];

    public function getPricingCalculatorOptions(){
        return [
            'standard'                          => 'Standard',
            'channel_and_currency_based'        => 'Channel and Currency based'
        ];
    }

    public function getProductsOptions(){
        $products = Product::all()->lists('name', 'id');
        return $products;
    }

    public function beforeSave()
    {
        if(count(post()) > 0){
            $manage_id = post('manage_id');
            if(!isset($manage_id)){
                $path = explode('/', Request::path());
                $id = last($path);
                if(!is_null($id)){
                    $product = Product::find($id);
                    $this->product = $product;
                    $name = $product->name;
                }

                $variant = post('Variant');
                $options = $variant['optionsValues'];
                if(!is_null($options)){
                    foreach ($options as $k => $v){
                        $ov = OptionValue::find($v);
                        $name .= ' - ' . $ov->value;
                        $this->optionsValues()->add($ov);
                    }
                    $this->name = $name;
                }
            }
        }
    }

    public function getItemForOrder($id)
    {
        $item = $this->find($id)->first();
        $product = $item->product;
        $tax_rate = $product->getTaxRate();
        dd($tax_rate->rate);
        if($this->isStockable($item)){
            if($item->on_hand > 0){
                $item->on_hold++;
                $item->on_hand--;
            }
            $item->save();
        }
        return $item;
    }

    public function isStockable(){
        return $this->tracked;
    }

    public function getTaxRate(){
        $product = Product::find($this->product_id)->first();
        return $product->getTaxRate();
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


}