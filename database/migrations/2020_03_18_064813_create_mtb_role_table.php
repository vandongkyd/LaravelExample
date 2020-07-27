<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMtbRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtb_role', function (Blueprint $table) {
            $table->id();
            $table->string("role_name")->nullable();
        });

        DB::table("mtb_role")->insert(
            array([
                "role_name" => "Quản trị viên"
            ],[
                "role_name" => "Quản lý"
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
        Schema::dropIfExists('mtb_role');
    }
}
