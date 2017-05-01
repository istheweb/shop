<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateShippingMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_shipping_methods', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('shipping_category_id')->unsigned();
            $table->integer('tax_category_id')->unsigned();
            $table->integer('zone_id')->unsigned();
            $table->string('code', 255)->unique();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('calculator')->default('flat_rate');
            $table->decimal('amount', 13, 2);
            $table->integer('category_requirement')->default(1);
            $table->tinyInteger('is_enabled')->default(1);
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_shipping_methods');
    }
}
