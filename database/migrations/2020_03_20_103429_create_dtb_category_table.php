<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtbCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("creator_id")->unsigned()->nullable();
            $table->string("category_name")->nullable();
            $table->integer("category_status")->default(0);
            $table->boolean("del_flg")->default(0);
            $table->dateTime("created")->useCurrent();
            $table->dateTime("updated")->useCurrent();

            $table->foreign("creator_id")->references("id")->on("dtb_member");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_category');
    }
}
