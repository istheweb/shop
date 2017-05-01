<?php namespace Istheweb\Shop\Models;


use October\Rain\Database\Model;
use October\Rain\Database\Traits\Purgeable;
use Request;


/**
 * AttributeValue Model
 */
class AttributeValue extends Model
{
    use Purgeable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'istheweb_shop_attribute_values';

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        /*'boolean_value',
        'text_value',
        'date_value',
        'datetime_value',
        'integer_value',*/
    ];

    /**
     * @var array
     */
    public $purgeable = ['value'];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'product'       => 'Istheweb\Shop\Models\Product',
        'attribute'     => 'Istheweb\Shop\Models\Attribute',
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];


    public function beforeSave()
    {

        if(count(post()) > 0){
            $attr = Attribute::find(post('attributes'));

            if($attr->type == 'checkbox') $type = 'boolean_value';
            else $type = $attr->type."_value";

            if($this->attribute && $this->attribute->id != $attr->id) {

                if($this->attribute->type == 'checkbox') $old_type = 'boolean_value';
                else $old_type = $this->attribute->type."_value";
                $this->{$old_type} = null;
            }
            $this->attribute = $attr;
            if(isset($this->attributes['model'])){

                $model = $this->attributes['model'];
                if($model == 'on') $this->{$type} = 1;
                else $this->{$type} = $model;
                array_forget($this->attributes, 'model');
            }
        }
    }

    public function getSelectedColumn($k){

        dd($k);
    }

}