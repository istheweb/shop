<?php namespace Istheweb\Shop\Models;


/**
 * OptionValue Model
 */
class OptionValue extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_option_values';

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
    public $hasMany = [];
    public $belongsTo = [
        'option'       => 'Istheweb\Shop\Models\Option'
    ];
    public $belongsToMany = [
        'variants' => ['Istheweb\Shop\Models\Variant',
            'table' => 'istheweb_shop_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}