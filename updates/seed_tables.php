<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 1/02/17
 * Time: 19:03
 */

namespace istheweb\shop\updates;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Istheweb\IsPdf\Models\Layout;
use Istheweb\IsPdf\Models\Template;
use Istheweb\Shop\Controllers\TaxCategories;
use Istheweb\Shop\Models\Address;
use Istheweb\Shop\Models\Attribute;
use Istheweb\Shop\Models\AttributeValue;
use Istheweb\Shop\Models\Category;
use Istheweb\Shop\Models\Channel;
use Istheweb\Shop\Models\Currency;
use Istheweb\Shop\Models\Customer;
use Istheweb\Shop\Models\Option;
use Istheweb\Shop\Models\OptionValue;
use Istheweb\Shop\Models\Order;
use Istheweb\Shop\Models\OrderStatus;
use Istheweb\Shop\Models\Product;
use Istheweb\Shop\Models\ShippingCategory;
use Istheweb\Shop\Models\ShippingMethod;
use Istheweb\Shop\Models\ShopSettings;
use Istheweb\Shop\Models\TaxCategory;
use Istheweb\Shop\Models\TaxRate;
use Istheweb\Shop\Models\Variant;
use Istheweb\Shop\Models\Zone;
use October\Rain\Database\Updates\Seeder;
use OpenCloud\Common\Constants\State;
use RainLab\Location\Models\Country;
use RainLab\User\Models\User;


class SeedTables extends Seeder
{
    public function run()
    {

        $categories = [
            [
                'name' => 'Moda y Accesorios',
                'slug' => 'moda-y-accesorios',
                'description' => '',
                'parent_id' => null,
                'nest_left' => 1,
                'nest_right' => 6,
                'nest_depth' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Hombre',
                'slug' => 'hombre',
                'description' => '',
                'parent_id' => 1,
                'nest_left' => 2,
                'nest_right' => 3,
                'nest_depth' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Mujer',
                'slug' => 'mujer',
                'description' => '',
                'parent_id' => 1,
                'nest_left' => 4,
                'nest_right' => 5,
                'nest_depth' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach($categories as $value){
            $category = new Category();
            foreach($value as $key => $value){
                $category->{$key} = $value;
            }
            $category->save();
        }

        $attributes = [
            [
                'code' => 'coleccion',
                'name' => 'Colección',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'marca',
                'name' => 'Marca',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'composicion',
                'name' => 'Composición',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach($attributes as $value){
            $attribute = new Attribute();
            foreach($value as $key => $value){
                $attribute->{$key} = $value;
            }
            $attribute->save();
        }

        $options = [
            [
                'code' => 't-shirt-size',
                'name' => 'Talla camisetas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'color',
                'name' => 'Color',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'code' => 'tallas-ropa-hombre',
                'name' => 'Talla ropa hombre',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach($options as $value){
            $option = new Option();
            foreach($value as $key => $value){
                $option->{$key} = $value;
            }
            $option->save();
        }

        $op_values = [
            [
                'option_id' => 1,
                'code' => 'size_s',
                'value' => 'S',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 1,
                'code' => 'size_m',
                'value' => 'M',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 1,
                'code' => 'size_l',
                'value' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 1,
                'code' => 'size_xl',
                'value' => 'XL',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 1,
                'code' => 'size_xxl',
                'value' => 'XXL',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'option_id' => 2,
                'code' => 'color_white',
                'value' => 'Blanco',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 2,
                'code' => 'color_black',
                'value' => 'Negro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 2,
                'code' => 'color_blue',
                'value' => 'Azul',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 2,
                'code' => 'color_red',
                'value' => 'Rojo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 2,
                'code' => 'color_yellow',
                'value' => 'Amarillo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'option_id' => 3,
                'code' => '46',
                'value' => '46',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 3,
                'code' => '48',
                'value' => '48',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 3,
                'code' => '50',
                'value' => '50',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 3,
                'code' => '52',
                'value' => '52',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'option_id' => 3,
                'code' => '54',
                'value' => '54',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach($op_values as $value){
            $opv = new OptionValue();
            foreach($value as $key => $value){
                $opv->{$key} = $value;
            }
            $opv->save();
        }

        Currency::create([
                'name' => 'Euro',
                'iso_code' => 'EUR',
                'iso_code_num' => 978,
                'sign' => '€',
                'format' => 2,
                'decimals' => 1,
                'conversion_rate' => 1.00,
                'active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
        ]);

        Currency::create([
            'name' => 'Dollar',
            'iso_code' => 'USD',
            'iso_code_num' => 840,
            'sign' => '$',
            'format' => 1,
            'decimals' => 1,
            'conversion_rate' => 1.00,
            'active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        $spain = Zone::create([
            'name' => 'España',
            'description' => 'Zona de las provincias de España exceptuando las islas, Ceuta y Melilla',
            'active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
        $country = Country::where('code', 'ES')->first();
        $spain->countries()->add($country);

        $taxes_group = TaxCategory::create([
            'code' => 'clothing',
            'name' => 'Ropa',
            'description' => 'Grupo de impuestos aplicado a la ropa',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $clothing_tax_group = TaxCategory::whereCode('clothing')->first();
        $tax = TaxRate::create([
            'tax_category_id' => $clothing_tax_group->id,
            'zone_id' => $spain->id,
            'name' => 'ES - Ropa - 21%',
            'type' => 'P',
            'rate' => 21.00,
            'active' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $shipping = ShippingCategory::create([
            'name' => 'Envios nacionales ES',
            'code' => 'spanish_shipping',
            'description' => 'Grupo de envio para las provincias de España',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $ups_shipping = ShippingMethod::create([
            'shipping_category_id' => $shipping->id,
            'tax_category_id' => $clothing_tax_group->id,
            'zone_id' => $spain->id,
            'code' => 'ups_spain',
            'name' => 'UPS - ES',
            'description' => 'Envio UPS a las provincias de la Península Ibérica',
            'calculator' => 'flat_rate',
            'amount' => 3.24,
            'category_requirement' => 1,
            'is_enabled' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()


        ]);
        $seur_shipping = ShippingMethod::create([
            'shipping_category_id' => $shipping->id,
            'tax_category_id' => $clothing_tax_group->id,
            'zone_id' => $spain->id,
            'code' => 'seur_spain',
            'name' => 'Seur - ES',
            'description' => 'Envio Seur a las provincias de la Península Ibérica',
            'calculator' => 'flat_rate',
            'amount' => 3.54,
            'category_requirement' => 1,
            'is_enabled' => 1,
            'position' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $es_channel = Channel::create([
            'default_locale_id' => 2,
            'base_currency_id' => 1,
            'tax_zone_id' => 1,
            'code' => 'ES_WEB',
            'name' => 'Tienda Online España',
            'color' => '#C0392B',
            'description' => '<p>Canal para la tienda de España</p>',
            'enabled' => 1,
            'hostname' => 'https://istheweb.com/es',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $products = [
           [
               'code' => '000000001',
               'name' => 'Parka de hombre',
               'slug' => 'parka-de-hombre',
               'tax_category_id' => 1,
               'shipping_category_id' => 1,
               'product_type' => 2,
               'caption' => '<p>Parka de color verder, con cierre de cremallera y automáticos, más una trabilla en el cuello.</p>',
               'description' => '<p>Parka con cierre de cremallera y automáticos, más una trabilla en el cuello. Lleva capucha extraíble mediante cremallera y dispone de cuatro bolsillos delanteros y uno en la manga izquierda. En su interior lleva un cordón en la cintura, para ajustar.</p>',
               'meta_keywords' => '',
               'meta_description' => '<p>Parka con cierre de cremallera y automáticos, más una trabilla en el cuello. Lleva capucha extraíble mediante cremallera y dispone de cuatro bolsillos delanteros y uno en la manga izquierda. En su interior lleva un cordón en la cintura, para ajustar.</p>',
               'short_description' => '<p>Parka de color verder, con cierre de cremallera y automáticos, más una trabilla en el cuello.</p>',
               'width' => null,
               'height' => null,
               'depth' => null,
               'weight' => null,
               'wholesaler_price' => 20.25,
               'price' => 125.00,
               'on_hold' => 0,
               'on_hand' => 50,
               'tracked' => 1,
               'available_on' => '2017-02-03 07:50:08',
               'available_until' => null,
               'enabled' => 1,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()

           ],
            [
                'code' => '000000002',
                'name' => 'Producto simple',
                'slug' => 'producto-simple',
                'tax_category_id' => 1,
                'shipping_category_id' => 1,
                'product_type' => 1,
                'caption' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>',
                'description' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>',
                'meta_keywords' => '',
                'meta_description' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>',
                'short_description' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>',
                'width' => null,
                'height' => null,
                'depth' => null,
                'weight' => null,
                'wholesaler_price' => 40.45,
                'price' => 175.00,
                'on_hold' => 0,
                'on_hand' => 50,
                'tracked' => 1,
                'available_on' => '2017-02-03 07:50:08',
                'available_until' => null,
                'enabled' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        foreach($products as $value){
            $opv = new Product();
            foreach($value as $key => $value){
                $opv->{$key} = $value;
            }
            $opv->save();
        }

        $att_values = [
           [
               'product_id' => 1,
               'attribute_id' => 2,
               'text_value' => 'Emidio Tucci',
               'boolean_value' => null,
               'integer_value' => null,
               'float_value' => null,
               'datetime_value' => null,
               'date_value' => null,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
           ],
            [
                'product_id' => 1,
                'attribute_id' => 1,
                'text_value' => 'Otoño / Invierno 2017',
                'boolean_value' => null,
                'integer_value' => null,
                'float_value' => null,
                'datetime_value' => null,
                'date_value' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'product_id' => 1,
                'attribute_id' => 3,
                'text_value' => '65 % Algodón 28 % Poliéster 7 % Nailon',
                'boolean_value' => null,
                'integer_value' => null,
                'float_value' => null,
                'datetime_value' => null,
                'date_value' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach($att_values as $value){
            $att_value = new AttributeValue();
            foreach($value as $key => $value){
                $att_value->{$key} = $value;
            }
            $att_value->save();
        }

        $variants = [
           [
               'product_id' => 1,
                'code' => '51324994',
               'name' => 'Parka de hombre - Verde - 48',
               'availableOn' => '2017-02-02 08:09:46',
               'availableUntil' => null,
               'on_hold' => 0,
               'on_hand' => 10,
               'tracked' => 1,
               'price' => 129,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
           ],
            [
                'product_id' => 1,
                'code' => '51324995',
                'name' => 'Parka de hombre - Verde - 50',
                'availableOn' => '2017-02-02 08:09:46',
                'availableUntil' => null,
                'on_hold' => 0,
                'on_hand' => 10,
                'tracked' => 1,
                'price' => 129,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'product_id' => 1,
                'code' => '51324996',
                'name' => 'Parka de hombre - Verde - 52',
                'availableOn' => '2017-02-02 08:09:46',
                'availableUntil' => null,
                'on_hold' => 0,
                'on_hand' => 10,
                'tracked' => 1,
                'price' => 129,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'product_id' => 1,
                'code' => '51324997',
                'name' => 'Parka de hombre - Verde - 54',
                'availableOn' => '2017-02-02 08:09:46',
                'availableUntil' => null,
                'on_hold' => 0,
                'on_hand' => 10,
                'tracked' => 1,
                'price' => 129,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach($variants as $value){
            $opv = new Variant();
            foreach($value as $key => $value){
                $opv->{$key} = $value;
            }
            $opv->save();
        }

        $pivots = [
           [
               'product_id' => null,
               'category_id' => null,
               'option_id' => null,
               'option_value_id' => null,
               'variant_id' => null,
               'country_id' => 210,
               'state_id' => null,
               'zone_id' => 1
           ],
            [
                'product_id' => 1,
                'category_id' => 1,
                'option_id' => null,
                'option_value_id' => null,
                'variant_id' => null,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => 1,
                'category_id' => 2,
                'option_id' => null,
                'option_value_id' => null,
                'variant_id' => null,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => 1,
                'category_id' => null,
                'option_id' => 2,
                'option_value_id' => null,
                'variant_id' => null,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => 1,
                'category_id' => null,
                'option_id' => 3,
                'option_value_id' => null,
                'variant_id' => null,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => null,
                'category_id' => null,
                'option_id' => null,
                'option_value_id' => 10,
                'variant_id' => 2,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => null,
                'category_id' => null,
                'option_id' => null,
                'option_value_id' => 14,
                'variant_id' => 2,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => null,
                'category_id' => null,
                'option_id' => null,
                'option_value_id' => 10,
                'variant_id' => 3,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => null,
                'category_id' => null,
                'option_id' => null,
                'option_value_id' => 15,
                'variant_id' => 3,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => null,
                'category_id' => null,
                'option_id' => null,
                'option_value_id' => 10,
                'variant_id' => 4,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => null,
                'category_id' => null,
                'option_id' => null,
                'option_value_id' => 16,
                'variant_id' => 4,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => null,
                'category_id' => null,
                'option_id' => null,
                'option_value_id' => 10,
                'variant_id' => 5,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => null,
                'category_id' => null,
                'option_id' => null,
                'option_value_id' => 17,
                'variant_id' => 5,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => 2,
                'category_id' => 1,
                'option_id' => null,
                'option_value_id' => null,
                'variant_id' => null,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ],
            [
                'product_id' => 2,
                'category_id' => 3,
                'option_id' => null,
                'option_value_id' => null,
                'variant_id' => null,
                'country_id' => null,
                'state_id' => null,
                'zone_id' => null
            ]

        ];

        foreach($pivots as $value){
            $opv = Db::table('istheweb_shop_pivots')->insert($value);
        }

        $invoice_layout = Layout::whereCode('iscorporate-invoices')->first();

        if(is_null($invoice_layout)){
            $pdf_layouts = [
                [
                    'code' => 'iscorporate-invoices',
                    'name' => 'IsCorporate Invoices',
                    'content_html' => '<html>\r\n    <head>\r\n        <style type="text/css" media="screen">\r\n            {{ css|raw }}\r\n        </style>\r\n    </head>\r\n    <body style="background: url({{ background_img }}) top left no-repeat;">\r\n        <div class="header">\r\n            <p class="left"></p>\r\n            <p class="right">\r\n                <strong>{{ company.name }}</strong><br>\r\n                <strong>{{ company.url}}</strong><br>\r\n            </p>\r\n        </div>\r\n        <div class="footer">\r\n        </div>\r\n        {{ content_html|raw }}\r\n    </body>\r\n</html>',
                    'content_css' => "@font-face {\r\n    font-family: \'Open Sans\';\r\n    src: url(\'plugins/renatio/dynamicpdf/assets/fonts/OpenSans-Regular.ttf\');\r\n}\r\n\r\n@font-face {\r\n    font-family: \'Open Sans\';\r\n    font-weight: bold;\r\n    src: url(\'plugins/renatio/dynamicpdf/assets/fonts/OpenSans-Bold.ttf\');\r\n}\r\n\r\n@font-face {\r\n    font-family: \'Open Sans\';\r\n    font-style: italic;\r\n    src: url(\'plugins/renatio/dynamicpdf/assets/fonts/OpenSans-Italic.ttf\');\r\n}\r\n\r\n@font-face {\r\n    font-family: \'Open Sans\';\r\n    font-style: italic;\r\n    font-weight: bold;\r\n    src: url(\'plugins/renatio/dynamicpdf/assets/fonts/OpenSans-BoldItalic.ttf\');\r\n}\r\n\r\n@page {\r\n    margin: 0;\r\n    padding: 0;\r\n}\r\n\r\nbody {\r\n    font-family: \'Open Sans\', sans-serif;\r\n    font-size: 14px;\r\n}\r\n\r\n.header {\r\n    position: fixed;\r\n    top: 3%;\r\n    left: 30%;\r\n}\r\n\r\n.header .left {\r\n    color: #373430;\r\n    font-size: .9em;\r\n    text-transform: uppercase;\r\n    width: 60%;\r\n    display: inline-block;\r\n}\r\n\r\n.header .right {\r\n    font-size: .7em;\r\n    color: #545554;\r\n    line-height: 1em;\r\n    text-align: right;\r\n    display: inline-block;\r\n    width: 30%;\r\n    padding-top: 1%;\r\n}\r\n\r\n.footer {\r\n    position: fixed;\r\n    bottom: 0;\r\n    left: 5%;\r\n    height: 12%;\r\n    font-size: .7em;\r\n    color: #545554;\r\n    line-height: 1em;\r\n}\r\n\r\n.footer .left {\r\n    display: inline-block;\r\n    width: 25%;\r\n}\r\n\r\n.footer .right {\r\n    display: inline-block;\r\n    width: 30%;\r\n    padding-top: 7%;\r\n}\r\n\r\n.content {\r\n    margin: 12% 0 0 10%;\r\n}\r\n\r\n.small-txt {\r\n    font-size: .7em;\r\n}\r\n\r\n.company-info {\r\n    display: inline-block;\r\n    width: 55%;\r\n    line-height: 1.1em;\r\n    font-size: 1.1em;\r\n}\r\n\r\n.customer-info {\r\n    display: inline-block;\r\n    width: 45%;\r\n    font-size: .9em;\r\n    height: 10%;\r\n}\r\n\r\n.summary {\r\n    margin: 10% 0 5% 0;\r\n    border-collapse: collapse;\r\n    width: 90%;\r\n}\r\n\r\n.summary th {\r\n    background-color: #BEBEBE;\r\n    border: 1px solid #000;\r\n    padding: 5px;\r\n}\r\n\r\n.summary td {\r\n    padding: 5px 10px;\r\n    border-right: 1px solid #000;\r\n}\r\n\r\n.summary .col-1 {\r\n    width: 15%;\r\n    text-align: center;\r\n    border-left: 1px solid #000;\r\n}\r\n\r\n.summary .col-2 {\r\n    width: 50%;\r\n}\r\n\r\n.summary .col-3 {\r\n    width: 15%;\r\n    text-align: right;\r\n}\r\n\r\n.summary .col-4 {\r\n    width: 20%;\r\n    text-align: right;\r\n}\r\n\r\n.summary .bt {\r\n    border-top: 1px solid #000;\r\n}\r\n\r\n.summary .sum-price .col-4 {\r\n    border-top: 1px solid #000;\r\n    border-bottom: 1px solid #000;\r\n}",
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ];

            foreach($pdf_layouts as $value){
                $opv = new Layout();
                foreach($value as $key => $value){
                    $opv->{$key} = $value;
                }
                $opv->save();
            }
        }

        $invoice_template = Template::whereCode('invoice-template')->first();

        if(is_null($invoice_template)){
            $pdf_templates = [
                [
                    'layout_id' => 1,
                    'code' => 'invoice-template',
                    'title' => 'Invoice Template',
                    'description' => '',
                    'content_html' => "<div class=\"content\">\r\n    <p class=\"small-txt\">{{ address }}</p>\r\n    \r\n    <p><strong>Nº de Pedido: {{ pdfNumber }}</strong><br><strong>Fecha: {{ \'now\'|date(\'d-m-Y\') }}</strong></p>\r\n\r\n    <p class=\"company-info\">\r\n        <strong>{{ company.name }}</strong><br>\r\n        <strong>{{ company.address }} </strong><br>\r\n        <strong>{{ company.zip_code }} {{ company.city }} {{ company.country }}</strong><br>\r\n        <strong>CIF: B90270711</strong>\r\n    </p>\r\n\r\n    <p class=\"customer-info\" >\r\n            <strong>CLIENTE</strong>: {{ cif }}<br>\r\n        {{ billingAddress|raw }}<br>\r\n        <strong>Dirección de envío</strong><br>\r\n        {{ shippingAddress|raw }}\r\n\r\n    </p>\r\n    \r\n    <table class=\"summary\">\r\n        <tr>\r\n            <th>Cantidad</th>\r\n            <th>Concepto</th>\r\n            <th>Precio</th>\r\n            <th>Neto</th>\r\n        </tr>\r\n        {% for item in items %}\r\n        <tr>\r\n            <td class=\"col-1\">{{ item.qty }}</td>\r\n            <td class=\"col-2\">{{ item.name }}</td>\r\n            <td class=\"col-3\">{{ item.price }} &euro;</td>\r\n            <td class=\"col-4\">{{ item.price }} &euro;</td>\r\n        </tr>\r\n        {% endfor %}\r\n\r\n        \r\n        <tr class=\"sum-price\">\r\n            <td colspan=\"3\" class=\"col-3 bt\">Subtotal</td>\r\n            <td class=\"col-4\">{{ subtotal }} &euro;</td>\r\n        </tr>\r\n        <tr class=\"sum-price\">\r\n            <td colspan=\"3\" class=\"col-3\"><strong>Total</strong></td>\r\n            <td class=\"col-4\">{{ total }} &euro;</td>\r\n        </tr>\r\n    </table>\r\n    <p><strong>Política de devoluciones</strong></p>\r\n\r\n    <p><small>Nuestra política de devolución es muy sencilla. <br>Podrás devolver cualquier artículo comprado en www.dxbwatch.es por las siguientes causas:</small></p>\r\n        <ul>\r\n            <li>Si el artículo presenta defectos de fabricación.</li>\r\n            <li>Si existe equivocación en el artículo enviado.</li>\r\n        </ul>\r\n        <p><small>En ambos casos el producto debe ser devuelto con todos sus accesorios y en el mismo estado en el que se entregó.<br>\r\n        En la recepción de mercancía errónea o dañada se aplicará el cambio físico de la misma solo si ésta fue reportada durante las primeras 72 horas posteriores a su entrega, en ningún caso se procederá a la devolución del importe abonado por el cliente, excepto si la reposición del producto no podemos hacerla en un plazo máximo de 7 días hábiles desde la recepción del producto devuelto.<br>\r\n        Para cualquier devolución deberás contactar con nuestro departamento de atención al cliente a través de correo electrónico mandando un email a: info@dxbwatch.es</small> </p>\r\n</div>",
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ];

            foreach($pdf_templates as $value){
                $opv = new Template();
                foreach($value as $key => $value){
                    $opv->{$key} = $value;
                }
                $opv->save();
            }
        }


        ShopSettings::set([
            'name'                  => 'Isthweb Shop',
            'owner'                 => 'Andrés Rangel',
            'invoiceTemplates'      => 'invoice-template',
            'default_customer_pass' => '12345',
            'checkoutSteps'         => '2',
            'country'               => $spain->id,
            'state'                 => 445,
            'currency'              => 1,
            "locale"                =>2,
            "length"                =>"centimeter",
            "weight"                =>"kilogram",
            "tax"                   =>1,
            "cash"                  =>"1",
            "cash_fee"              =>"6",
            "paypal"                =>"1",
            "paypal_client_id"      =>"AfrxRYym-GH9DgpQlo42ZONvFLtQNXU48H7EmJmX-5mXrweN59xAVav2YgBe8o6DBdpB7VPemd3Fl5Ub",
            "paypal_secret_id"      =>"EE5J5rxPySdBBt6DpER5tJF7Qw4LLNhrjNWbX1ezHGTa80lvkoHCj_73ZMWXTh9NLjCQa70SRFppq96x",
            "paypal_url_ok"         =>"http://istheweb.com/shop/checkout/?success=true",
            "paypal_url_ko"         =>"http://istheweb.com/shop/checkout/?success=false",
            "paypal_fee"            =>"2",
            "tpv"                   =>"0",
            "tpv_fuc"               =>"",
            "tpv_terminal"          =>"",
            "tpv_url_ok"            =>"",
            "tpv_url_ko"            =>"",
            "tpv_signature"         =>"",
            "tpv_fee"               =>"",
            "stripe"                =>"1",
            "stripe_api_id"         =>"sk_test_oYCrozeSUArnP7bQuwXBelRs",
            "stripe_publishable_key"=>"pk_test_z8YEe39Hldwsz5ANW3uHCD4R",
            "stripe_fee"            =>"2",
            "social"                =>[],
            "currency"              =>"1",
            "order_reference"       =>"2000000"
        ]);

        $customer = new Customer();
        $customer->user = User::find(1);
        $customer->phone = '955712646';
        $customer->mobile = '647583630';
        $customer->cif = '123456789F';
        $customer->save();

        $address = new Address();
        $address->customer = $customer;
        $address->country = Country::find(210);
        $address->state = \RainLab\Location\Models\State::find(445);
        $address->address_1 = 'Calle Bernardo Caballero de Carpio, 28';
        $address->city = 'Espartinas';
        $address->postcode = '41807';
        $address->save();

    }
}