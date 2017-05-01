<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 12/05/16
 * Time: 8:03
 */

namespace Istheweb\Shop\Updates;


use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreatePivotsTable extends Migration
{
    public $models = [
        'product',
        'category',
        'option',
        'option_value',
        'variant',
        'country',
        'state',
        'zone',
    ];

    public function up()
    {
        Schema::create('istheweb_shop_pivots', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            foreach ($this->models as $model) {
                $table->integer($model . '_id')->unsigned()->nullable()->index();
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_pivots');
    }

}