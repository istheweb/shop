<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateAttributeValuesTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_attribute_values', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->string('text_value', 255)->nullable();
            $table->boolean('boolean_value')->nullable();
            $table->integer('integer_value')->nullable();
            $table->float('float_value')->nullable();
            $table->dateTime('datetime_value')->nullable();
            $table->date('date_value')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_attribute_values');
    }
}
