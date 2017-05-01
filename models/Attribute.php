<?php namespace Istheweb\Shop\Models;

/**
 * Attribute Model
 */
class Attribute extends Base
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_attributes';


    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'attributeValues'       => 'Istheweb\Shop\Models\AttributeValue'
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


    public static function getAttributeTypeOptions(){
        return [
            'text'      => 'Text',
            'checkbox'  => 'Checkbox',
            'integer'   => 'Integer',
            'percent'   => 'Percent',
            'datetime'  => 'Date Time',
            'date'      => 'Date'
        ];
    }

    public static function getAllAtributes(){
        return self::all()->lists('name', 'id');
    }

    public function getTypeOptions(){
        return self::getAttributeTypeOptions();
    }

    public function beforeSave()
    {
        $attribute = post('Attribute');
        $this->storage_type = $attribute['type'] ?: '';
        $this->configuration = 'a:0:{}';
    }

}