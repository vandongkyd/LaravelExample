<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->unsigned()->nullable();
            $table->string('cart_key')->nullable();
            $table->string('total_price')->nullable();
            $table->dateTime('created')->useCurrent();
            $table->dateTime('updated')->useCurrent();

            $table->foreign('customer_id')->references('id')->on('dtb_customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_cart');
    }
}
