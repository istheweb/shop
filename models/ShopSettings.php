<?php namespace Istheweb\Shop\Models;

use Illuminate\Support\Facades\Lang;
use Istheweb\IsPdf\Models\Template;
use October\Rain\Database\Model as BaseModel;
use RainLab\Translate\Models\Locale;
use RainLab\Location\Models\Country;
use RainLab\Location\Models\State;

/**
 * ShopSettings Model
 */
class ShopSettings extends BaseModel
{

    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'istheweb_system_shop_settings';
    public $settingsFields = 'fields.yaml';

    public $attachOne = [
        'logo' => ['System\Models\File'],
    ];


    public function getCountryOptions(){
        return Country::where('is_enabled', 1)->lists('name', 'id');
    }

    public function getStateOptions(){

        return State::where('country_id', $this->country)->lists('name', 'id');
    }

    public function getLocaleOptions() {
        return Locale::all()->lists('name', 'id');
    }

    public function getCurrencyOptions(){
        return Currency::all()->lists('name', 'id');
    }

    public function getTaxOptions(){
        return TaxRate::all()->lists('name', 'id');
    }

    public function getLengthOptions() {
        return [
            'centimeter'        => Lang::get('istheweb.shop::lang.fields.centimeter'),
            'millimeter'        => Lang::get('istheweb.shop::lang.fields.millimeter'),
            'inch'              => Lang::get('istheweb.shop::lang.fields.inch'),
        ];
    }

    public function getWeightOptions(){
        return [
            'kilogram'          => Lang::get('istheweb.shop::lang.fields.kilogram'),
            'gram'              => Lang::get('istheweb.shop::lang.fields.gram'),
            'pound'             => Lang::get('istheweb.shop::lang.fields.pound'),
            'ounce'             => Lang::get('istheweb.shop::lang.fields.ounce'),
        ];
    }

    public function getPaymentMethodOptions(){
        return [
            'cash'              => Lang::get('istheweb.shop::lang.fields.cash_delivery'),
            'paypal'            => Lang::get('istheweb.shop::lang.fields.paypal'),
            'tpv'               => Lang::get('istheweb.shop::lang.fields.tarjeta'),
            'stripe'            => Lang::get('istheweb.shop::lang.fields.stripe'),
        ];
    }

    public function getInvoiceTemplatesOptions(){
        $templates = Template::all()->lists('title', 'code');
        return $templates;
    }

    public function getCheckoutStepsOptions(){
        return [
            '2'     => '2',
            '3'     => '3',
            '4'     => '4',
            '5'     => '5'
        ];
    }

}