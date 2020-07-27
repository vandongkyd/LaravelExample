<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbProductRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_product_rating', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id")->unsigned();
            $table->unsignedBigInteger("customer_id")->unsigned();
            $table->double("star")->default(0);
            $table->string("comment")->nullable();
            $table->dateTime("created")->useCurrent();
            $table->dateTime("updated")->useCurrent();

            $table->foreign("product_id")->references("id")->on("dtb_product");
            $table->foreign("customer_id")->references("id")->on("dtb_customer");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_product_rating');
    }
}
