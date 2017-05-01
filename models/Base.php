<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 14/12/16
 * Time: 7:14
 */

namespace Istheweb\Shop\Models;

use October\Rain\Database\Model as BaseModel;

class Base extends BaseModel
{
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = [
        'name',
        'slug',
        'caption',
        'description',
        'meta_keywords',
        'meta_description',
        'short_description',
        'text_value',
        'value'
    ];
}