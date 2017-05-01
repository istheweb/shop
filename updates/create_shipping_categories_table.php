<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateShippingCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_shipping_categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code', 255)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_shipping_categories');
    }
}
