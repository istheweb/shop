<?php namespace Istheweb\Shop\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('istheweb_shop_payments', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->string('currency_code', 3);
            $table->string('state', 255)->default('cart');
            $table->integer('amount');
            $table->longText('details')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('istheweb_shop_payments');
    }
}

