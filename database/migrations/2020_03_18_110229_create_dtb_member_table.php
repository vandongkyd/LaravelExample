<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDtbMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtb_member', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->string("phone")->nullable();
            $table->string("address")->nullable();
            $table->string("avatar")->nullable();
            $table->unsignedBigInteger('role_id')->unsigned()->nullable();
            $table->integer("status")->default(0);
            $table->rememberToken();
            $table->boolean("del_flg")->default(0);
            $table->dateTime("created")->useCurrent();
            $table->dateTime("updated")->useCurrent();

            $table->foreign("role_id")->references("id")->on("mtb_role");

        });
        DB::table("dtb_member")->insert(
            array([
                "user_name" => "admin",
                "full_name" => "Admin",
                "role_id" => "1",
                'password' => bcrypt('password')
            ])
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtb_member');
    }
}
