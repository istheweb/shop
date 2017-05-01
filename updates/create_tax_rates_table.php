<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTaxRatesTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_tax_rates', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tax_category_id')->unsigned();
            $table->integer('zone_id')->unsigned();
            $table->string('name');
            $table->char('type', 1);
            $table->decimal('rate', 13, 2);
            $table->tinyInteger('active')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_tax_rates');
    }
}
