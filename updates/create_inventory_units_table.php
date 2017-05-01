<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 11/04/17
 * Time: 16:16
 */

namespace istheweb\shop\updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateInventoryUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_inventory_units', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');$table->integer('stockable_id')->unsigned();
            $table->string('stockable_type');
            $table->string('state')->default('checkout');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_inventory_units');
    }
}