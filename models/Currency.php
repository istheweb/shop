<?php namespace Istheweb\Shop\Models;

use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Currency Model
 */
class Currency extends Base
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_currencies';


    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name',
        'iso_code',
        'sign',
        'format',
        'decimals',
        'conversion_rate',
        'active'
    ];

    /**
     * @var array Validation rules
     */
    protected $rules = [
        'name' => 'required|max:32',
        'iso_code' => 'required|max:3',
        'iso_code_num' => 'required|max:3',
        'sign'  => 'required',

    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getFormatOptions()
    {
        return [
            '1' => 'X0 000.00',
            '2' => '0,000.00X',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}