<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_variants', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('code')->unique();
            $table->string('name');
            $table->dateTime('availableOn')->nullable();
            $table->dateTime('availableUntil')->nullable();
            $table->integer('on_hold')->default(0);
            $table->integer('on_hand')->default(0);
            $table->tinyInteger('tracked')->default(0);
            $table->integer('price');
            $table->string('pricing_calculator', 255);
            $table->longText('pricing_configuration')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('depth')->nullable();
            $table->double('weight')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_variants');
    }
}
