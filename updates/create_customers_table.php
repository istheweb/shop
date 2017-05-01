<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_customers', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('phone', 9)->nullable();
            $table->string('mobile', 9)->nullable();
            $table->string('fax', 9)->nullable();
            $table->string('cif', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_customers');
    }
}
