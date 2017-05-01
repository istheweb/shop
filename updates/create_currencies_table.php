<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_currencies', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 32);
            $table->string('iso_code', 3);
            $table->string('iso_code_num', 3);
            $table->string('sign', 8);
            $table->tinyInteger('format')->unsigned();
            $table->tinyInteger('decimals')->default(1)->unsigned();
            $table->decimal('conversion_rate', 13, 2);
            $table->tinyInteger('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_currencies');
    }
}
