<?php namespace Istheweb\Shop\Models;

use Model;

/**
 * Zone Model
 */
class Zone extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_zones';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'taxRates' => 'Istheweb\Shop\Models\TaxRate',
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'countries' => [
            'RainLab\Location\Models\Country',
            'table' => 'istheweb_shop_pivots',
        ],
        'states' => [
            'RainLab\Location\Models\State',
            'table' => 'istheweb_shop_pivots',
        ],
    ];

    public function afterDelete()
    {
        if($this->countries()) $this->countries()->detach();
        if($this->states()) $this->states()->detach();
    }

    public function getCountriesOptions(){
        return Country::where('is_enabled', 1)->get();
    }

    public function getStatesOptions()
    {
        return State::where($this->countries())->lists('name', 'id', 'code');

    }

}