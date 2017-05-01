<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_attributes', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('type');
            $table->string('storage_type');
            $table->longText('configuration');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_attributes');
    }
}
