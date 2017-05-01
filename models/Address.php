<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use October\Rain\Support\Facades\Flash;
use RainLab\Location\Models\Country;
use RainLab\Location\Models\State;

/**
 * Address Model
 */
class Address extends Base
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_addresses';

    /**
     * @var array Guarded fields
     */
    protected $rules = [
        'address_1' => 'required',
        'country'   => 'required',
        'state'     => 'required',
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'address_1',
        'address_2',
        'city',
        'postcode',
        'customer'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'customer'          => 'Istheweb\Shop\Models\Customer',
        'country'           => 'RainLab\Location\Models\Country',
        'state'             => 'RainLab\Location\Models\State',
    ];
    public $belongsToMany = [];

    public function beforeValidate()
    {
        $address = Address::where('address_1', '=', post('Address[address_1]'))
            ->where('customer_id', post('Address[customer]'))->first();

        if(!is_null($address) && $address->exists){
            Flash::error('Ya existe la dirección para este cliente');
            return false;
        }
    }

    public function afterCreate()
    {
        dd(dump(post()));
    }

    public function afterUpdate()
    {
        dd(dump(post()));
    }


    public function getCountryOptions(){
        return Country::where('is_enabled', 1)->lists('name', 'id', 'code');
    }

    public function getCountriesOptions(){
        return Country::where('is_enabled', 1)->get();
    }

    public function getStateOptions()
    {
        if($this->country){
            $data = State::where('country_id', '=', $this->country->id)->lists('name', 'id', 'code');
        }else{
            $spain = Country::whereCode('es')->first();
            $data = State::where('country_id', '=', $spain->id)->lists('name', 'id', 'code');
        }

        return $data;
    }

    public function getAddresses()
    {
        return Address::all()->lists('id', 'address_1');
    }

    public function scopeIsEnabled($query, $address, $customer){
        $query->where('address_1', '=', $address)
            ->where('customer_id', $customer);
    }

    public function scopeFindByCustomer($query)
    {
        if(post('Customer[user]')){
            $customer = Customer::where('user_id', '=', post('Customer[user]'))->first();
            $customer_id = $customer->id;
        }else{
            /**
             * no queremos encontrar registros
             */
            $customer_id = 999999999999999;
        }
        $query->where('customer_id', '=', $customer_id);
    }

}