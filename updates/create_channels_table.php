<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateChannelsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_channels', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('default_locale_id')->unsigned()->nullable();
            $table->integer('base_currency_id')->unsigned()->nullable();
            $table->integer('tax_zone_id')->unsigned()->nullable();
            $table->string('code');
            $table->string('name');
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('enabled')->default(0);
            $table->string('hostname')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_channels');
    }
}
