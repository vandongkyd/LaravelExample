<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbProductImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_product_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id")->unsigned()->nullable();
            $table->string("file_name")->nullable();

            $table->foreign("product_id")->references("id")->on("dtb_product");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_product_image');
    }
}
