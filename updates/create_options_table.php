<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_options', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_options');
    }
}
