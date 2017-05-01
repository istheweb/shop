<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_products', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name', 255)->index();
            $table->string('slug', 255)->index()->unique();
            $table->integer('channel_id')->unsigned()->nullable();
            $table->integer('tax_category_id')->unsigned()->nullable();
            $table->integer('shipping_category_id')->unsigned()->nullable();
            $table->integer('product_type')->default(1);
            $table->string('caption')->nullable();
            $table->longText('description')->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->longText('short_description')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('depth')->nullable();
            $table->double('weight')->nullable();
            $table->double('volume')->nullable();
            $table->decimal('wholesaler_price', 13,2)->nullable();
            $table->decimal('price', 13,2)->nullable();
            $table->integer('on_hold')->default(0);
            $table->integer('on_hand')->default(0);
            $table->tinyInteger('tracked')->default(0);
            $table->dateTime('available_on')->nullable();
            $table->dateTime('available_until')->nullable();
            $table->boolean('enabled');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_products');
    }
}
