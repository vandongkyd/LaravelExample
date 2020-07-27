<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbCartItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_cart_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id')->unsigned();
            $table->unsignedBigInteger('product_id')->unsigned();
            $table->string('unit_price')->nullable();
            $table->integer('quantity')->nullable();

            $table->foreign('cart_id')->references('id')->on('dtb_cart');
            $table->foreign('product_id')->references('id')->on('dtb_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_cart_item');
    }
}
