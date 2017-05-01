<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateZonesTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_zones', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_zones');
    }
}
