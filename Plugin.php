<?php namespace Istheweb\Shop;

use App;
use Backend\Facades\BackendAuth;
use BackendMenu;
use Config;
use Event;
use Backend;
use Illuminate\Foundation\AliasLoader;
use Istheweb\Shop\Models\Category as ProductCategory;
use Istheweb\Shop\Models\Customer;
use System\Classes\PluginBase;

/**
 * Shop Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['RainLab.Location', 'RainLab.User', 'Istheweb.IsPdf'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'istheweb.shop::lang.plugin.name',
            'description' => 'istheweb.shop::lang.plugin.description',
            'author'      => 'Andres Rangel',
            'icon'        => 'icon-shopping-cart',
        ];
    }

    public function registerNavigation()
    {
        return [
            'shop' => [
                'label'       => 'istheweb.shop::lang.plugin.name',
                'url'         => Backend::url('istheweb/shop/'. $this->startPage()),
                'icon'        => 'icon-shopping-cart',
                'permissions' => ['istheweb.shop.*'],
                'order'       => 450,

                'sideMenu'    => [

                    'products'     => [
                        'label'       => 'istheweb.shop::lang.products.menu_label',
                        'icon'        => 'icon-rocket',
                        'url'         => Backend::url('istheweb/shop/products'),
                        'permissions' => ['istheweb.shop.access_products'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.product.description',
                    ],
                    'categories'     => [
                        'label'       => 'istheweb.shop::lang.categories.menu_label',
                        'icon'        => 'icon-cubes',
                        'url'         => Backend::url('istheweb/shop/categories'),
                        'permissions' => ['istheweb.shop.access_categories'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.category.description',
                    ],
                    'attributes'     => [
                        'label'       => 'istheweb.shop::lang.attributes.menu_label',
                        'icon'        => 'icon-filter',
                        'url'         => Backend::url('istheweb/shop/attributes'),
                        'permissions' => ['istheweb.shop.access_attributes'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.attributes.description',
                    ],
                    'options'     => [
                        'label'       => 'istheweb.shop::lang.options.menu_label',
                        'icon'        => 'icon-diamond',
                        'url'         => Backend::url('istheweb/shop/options'),
                        'permissions' => ['istheweb.shop.access_options'],
                        'group'       => 'istheweb.shop::lang.sidebar.catalog',
                        'description' => 'istheweb.shop::lang.options.description',
                    ],
                    'orders'     => [
                        'label'       => 'istheweb.shop::lang.orders.menu_label',
                        'icon'        => 'icon-cart-arrow-down',
                        'url'         => Backend::url('istheweb/shop/orders'),
                        'permissions' => ['istheweb.shop.access_orders'],
                        'group'       => 'istheweb.shop::lang.sidebar.orders',
                        'description' => 'istheweb.shop::lang.order.description',
                    ],
                    'orderstatuses'     => [
                        'label'       => 'istheweb.shop::lang.order_statuses.menu_label',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('istheweb/shop/orderstatuses'),
                        'permissions' => ['istheweb.shop.access_order_statuses'],
                        'group'       => 'istheweb.shop::lang.sidebar.orders',
                        'description' => 'istheweb.shop::lang.order_status.description',
                    ],
                    'customers'     => [
                        'label'       => 'istheweb.shop::lang.customers.menu_label',
                        'icon'        => 'icon-user',
                        'url'         => Backend::url('istheweb/shop/customers'),
                        'permissions' => ['istheweb.shop.access_customers'],
                        'group'       => 'istheweb.shop::lang.customers.menu_label',
                        'description' => 'istheweb.shop::lang.customer.description',
                    ],
                    'currencies'     => [
                        'label'       => 'istheweb.shop::lang.currencies.menu_label',
                        'icon'        => 'icon-money',
                        'url'         => Backend::url('istheweb/shop/currencies'),
                        'permissions' => ['istheweb.shop.access_currency'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.currencies.description',
                    ],
                    'zones'     => [
                        'label'       => 'istheweb.shop::lang.zones.menu_label',
                        'icon'        => 'icon-globe',
                        'url'         => Backend::url('istheweb/shop/zones'),
                        'permissions' => ['istheweb.shop.access_zones'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.zone.description',
                    ],
                    'taxrates'     => [
                        'label'       => 'istheweb.shop::lang.tax_rates.menu_label',
                        'icon'        => 'icon-gavel',
                        'url'         => Backend::url('istheweb/shop/taxrates'),
                        'permissions' => ['istheweb.shop.access_tax_rates'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.tax_rate.description',
                    ],
                    'taxcatgories'     => [
                        'label'       => 'istheweb.shop::lang.tax_categories.menu_label',
                        'icon'        => 'icon-briefcase',
                        'url'         => Backend::url('istheweb/shop/taxcategories'),
                        'permissions' => ['istheweb.shop.access_tax_categories'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.tax_category.description',
                    ],
                    'channels'     => [
                        'label'       => 'istheweb.shop::lang.channels.menu_label',
                        'icon'        => 'icon-plug',
                        'url'         => Backend::url('istheweb/shop/channels'),
                        'permissions' => ['istheweb.shop.access_channels'],
                        'group'       => 'istheweb.shop::lang.sidebar.localization',
                        'description' => 'istheweb.shop::lang.channel.description',
                    ],
                    'shippingcategories'     => [
                        'label'       => 'istheweb.shop::lang.shipping_categories.menu_label',
                        'icon'        => 'icon-archive',
                        'url'         => Backend::url('istheweb/shop/shippingcategories'),
                        'permissions' => ['istheweb.shop.access_shipping_categories'],
                        'group'       => 'istheweb.shop::lang.sidebar.shippings',
                        'description' => 'istheweb.shop::lang.shipping_category.description',
                    ],
                    'shippingmethods'     => [
                        'label'       => 'istheweb.shop::lang.shipping_methods.menu_label',
                        'icon'        => 'icon-truck',
                        'url'         => Backend::url('istheweb/shop/shippingmethods'),
                        'permissions' => ['istheweb.shop.access_shipping_methods'],
                        'group'       => 'istheweb.shop::lang.sidebar.shippings',
                        'description' => 'istheweb.shop::lang.shipping_method.description',
                    ]
                ],
            ],
        ];
    }

    public function startPage($page = 'projects')
    {
        $user = BackendAuth::getUser();
        $permissions = array_reverse(array_keys($this->registerPermissions()));

        if (!isset($user->permissions['superuser']) && $user->hasAccess('istheweb.shop.*')) {
            foreach ($permissions as $access) {
                if ($user->hasAccess($access)) {
                    $page = explode('_', $access)[1];
                }
            }
        }
        //print_r($page);
        return $page;
    }

    public function registerPermissions()
    {
        return [

            'istheweb.shop.access_products'     => [
                'label' => 'istheweb.shop::lang.product.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.create_products'     => [
                'label' => 'istheweb.shop::lang.product.create_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.delete_products'     => [
                'label' => 'istheweb.shop::lang.product.delete_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_categories'     => [
                'label' => 'istheweb.shop::lang.category.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_attributes'     => [
                'label' => 'istheweb.shop::lang.attribute.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_options'     => [
                'label' => 'istheweb.shop::lang.option.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_currency'     => [
                'label' => 'istheweb.shop::lang.currency.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_zones'     => [
                'label' => 'istheweb.shop::lang.zones.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_tax_rates'     => [
                'label' => 'istheweb.shop::lang.tax_rates.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_shipping_categories'     => [
                'label' => 'istheweb.shop::lang.shipping_categories.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_shipping_methods'     => [
                'label' => 'istheweb.shop::lang.shipping_methods.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_customers'     => [
                'label' => 'istheweb.shop::lang.customers.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_orders'     => [
                'label' => 'istheweb.shop::lang.order.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_order_statuses'     => [
                'label' => 'istheweb.shop::lang.order_status.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ],
            'istheweb.shop.access_channels'     => [
                'label' => 'istheweb.shop::lang.channel.list_title',
                'tab'   => 'istheweb.shop::lang.plugin.name',
            ]
        ];
    }

    public function registerComponents()
    {
        return [

        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Istheweb\Shop\FormWidgets\ProductVariantOptions'  => [
                'label' => 'istheweb.shop::lang.product.options',
                'code'  => 'product_variant_options'
            ],
            'Istheweb\Shop\FormWidgets\ProductAttributeValues'  => [
                'label' => 'istheweb.shop::lang.product.attributes',
                'code'  => 'product_attribute_options'
            ],
            'Istheweb\Shop\FormWidgets\UserClient'  => [
                'label' => 'istheweb.shop::lang.customer.attributes',
                'code'  => 'user_client'
            ],
            'Istheweb\Shop\FormWidgets\ClientAddress'  => [
                'label' => 'istheweb.shop::lang.address.attributes',
                'code'  => 'client_address'
            ],
            'Istheweb\Shop\FormWidgets\OrderItemVariant'  => [
                'label' => 'istheweb.shop::lang.order_item.attributes',
                'code'  => 'order_item_variant'
            ]
        ];
    }

    // SETTINGS
    public function registerSettings(){
        return [
            /*'slack'           => [
                'label'       => 'istheweb.connect::lang.slack',
                'description' => 'istheweb.connect::lang.slack_description',
                'icon'        => 'icon-slack',
                'class'       => 'Istheweb\Connect\Models\SlackSettings',
                'category'    => 'istheweb.connect::lang.manage',
                'order'       => 101,
                'keywords'    => 'crm customer relationship management slack'
            ],*/
            'shop' => [
                'label'       => 'istheweb.shop::lang.plugin.name',
                'description' => 'istheweb.shop::lang.plugin.config_description',
                'icon'        => 'icon-shopping-bag',
                'class'       => 'Istheweb\Shop\Models\ShopSettings',
                'category'    => 'istheweb.connect::lang.manage',
                'order'       => 105,
                'keywords'    => 'shop relationship sell mail'
            ]
        ];
    }

    public function registerMailTemplates()
    {
        return [

        ];
    }

    /**
     * Register snippets with the RainLab.Pages plugin.
     *
     * @return array
     * @see https://octobercms.com/plugin/rainlab-pages
     */
    public function registerPageSnippets()
    {
        return [

        ];
    }

    public function register()
    {
        // Register ServiceProviders
        //App::register('Sebdesign\SM\ServiceProvider');
        // Register aliases
        $alias = AliasLoader::getInstance();
        //$alias->alias('StateMachine', 'Sebdesign\SM\Facade');

        BackendMenu::registerContextSidenavPartial('Istheweb.Shop', 'shop', 'plugins/istheweb/shop/partials/_sidebar.htm');
        set_exception_handler([$this, 'handleException']);
    }

    /**
     * Workaround to resolve
     * TypeError: Argument 1 passed to October\Rain\Foundation\Exception\Handler::report() must be an instance of Exception
     * This error is fixed by octobercms/library@83888f4
     * witch Fixes seg fault (infinite loop) when using remember()
     * but while it's not in dev-master branch we use this workaround function
     * @param $e Exception
     */
    public function handleException($e)
    {
        if (! $e instanceof Exception) {
            $e = new \Symfony\Component\Debug\Exception\FatalThrowableError($e);
        }

        $handler = $this->app->make('Illuminate\Contracts\Debug\ExceptionHandler');
        $handler->report($e);

        if ($this->app->runningInConsole()) {
            $handler->renderForConsole(new ConsoleOutput, $e);
        } else {
            $handler->render($this->app['request'], $e)->send();
        }
    }

    public function boot()
    {
        // Setup required packages
        $this->bootPackages();

        /*
         * Register menu items for the RainLab.Pages plugin
        */
        Event::listen('pages.menuitem.listTypes', function() {
            return [
                'product-category'       => 'istheweb.shop::lang.menuitem.product_category',
                'all-product-categories' => 'istheweb.shop::lang.menuitem.all_product_categories'
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function($type) {
            if ($type == 'product-category' || $type == 'all-product-categories') {
                return ProductCategory::getMenuTypeInfo($type);
            }
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
            if ($type == 'product-category' || $type == 'all-product-categories') {
                return ProductCategory::resolveMenuItem($item, $url, $theme);
            }
        });
    }

    public function registerListColumnTypes()
    {
        return [
            'productable_order_item'    => [$this, 'evalProductableOrderItemListColumn'],
            'customer_order_name'       => [$this, 'evalCustomerOrderNameListColumn'],
        ];
    }

    public function evalProductableOrderItemListColumn($value, $column, $record)
    {
        $type = $record->productable_type;
        $instance = $type::find($value);
        return strtoupper($instance->name);
    }

    public function evalCustomerOrderNameListColumn($value, $column, $record)
    {
        $user = Customer::getUserByCustomerId($value);
        return ucwords($user->name . " " . $user->surname . ' ('.$user->email.')', ' ');
    }

    /**
     * Boots (configures and registers) any packages found within this plugin's packages.load configuration value
     *
     * @see https://luketowers.ca/blog/how-to-use-laravel-packages-in-october-plugins
     * @author Luke Towers <octobercms@luketowers.ca>
     */
    public function bootPackages()
    {
        // Get the namespace of the current plugin to use in accessing the Config of the plugin
        $pluginNamespace = str_replace('\\', '.', strtolower(__NAMESPACE__));

        // Instantiate the AliasLoader for any aliases that will be loaded
        $aliasLoader = AliasLoader::getInstance();

        // Get the packages to boot
        $packages = Config::get($pluginNamespace . '::packages');

        // Boot each package
        foreach ($packages as $name => $options) {
            // Setup the configuration for the package, pulling from this plugin's config
            if (!empty($options['config']) && !empty($options['config_namespace'])) {
                Config::set($options['config_namespace'], $options['config']);
            }

            // Register any Service Providers for the package
            if (!empty($options['providers'])) {
                foreach ($options['providers'] as $provider) {
                    App::register($provider);
                }
            }

            // Register any Aliases for the package
            if (!empty($options['aliases'])) {
                foreach ($options['aliases'] as $alias => $path) {
                    $aliasLoader->alias($alias, $path);
                }
            }
        }
    }
}
