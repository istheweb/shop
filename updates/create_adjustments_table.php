<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateAdjustmentsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_adjustments', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('orderable_id')->unsigned();
            $table->string('orderable_type');
            $table->string('type', 255);
            $table->string('name');
            $table->integer('amount');
            $table->tinyInteger('is_neutral')->default(0);
            $table->tinyInteger('is_locked')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_adjustments');
    }
}
