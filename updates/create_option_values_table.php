<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOptionValuesTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_option_values', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('option_id')->unsigned();
            $table->string('code')->unique();
            $table->string('value', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_option_values');
    }
}
