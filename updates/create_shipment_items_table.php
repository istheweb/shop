<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateShipmentItemsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_shipment_items', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('shipment_id')->unsigned();
            $table->integer('shippable_id')->unsigned();
            $table->string('shippable_type');
            $table->string('state')->default('ready');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_shipment_items');
    }
}
