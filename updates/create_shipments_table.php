<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateShipmentsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_shipments', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('shipping_method_id')->unsigned();
            $table->string('state')->default('ready');
            $table->string('tracking')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_shipments');
    }
}
