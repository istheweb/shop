<?php namespace Istheweb\Shop\Models;


/**
 * Option Model
 */
class Option extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_options';

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
        'values'          => 'Istheweb\Shop\Models\OptionValue'
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'products' => ['Istheweb\Shop\Models\Product',
            'table' => 'istheweb_shop_pivots',
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}