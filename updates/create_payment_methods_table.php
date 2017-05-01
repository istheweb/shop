<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_payment_methods', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('getaway');
            $table->json('environment')->nullable();
            $table->boolean('enabled')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_payment_methods');
    }
}
