<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("creator_id")->unsigned()->nullable();
            $table->unsignedBigInteger("category_id")->unsigned()->nullable();
            $table->string("product_name")->nullable();
            $table->string("product_price")->nullable();
            $table->integer("product_quantity")->nullable();
            $table->string("product_image")->nullable();
            $table->string("product_content")->nullable();
            $table->integer("product_view")->default(0);
            $table->double("product_rating")->default(0);
            $table->integer("product_selling")->default(0);
            $table->integer("product_status")->default(0);
            $table->boolean("del_flg")->default(0);
            $table->dateTime("created")->useCurrent();
            $table->dateTime("updated")->useCurrent();

            $table->foreign("creator_id")->references("id")->on("dtb_member");
            $table->foreign("category_id")->references("id")->on("dtb_category");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_product');
    }
}
