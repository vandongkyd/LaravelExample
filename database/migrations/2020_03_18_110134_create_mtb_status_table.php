<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMtbStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtb_status', function (Blueprint $table) {
            $table->id();
            $table->string("status_name")->nullable();
        });

        DB::table("mtb_status")->insert(
            array([
                'status_name' => 'Mới',
            ],[
                'status_name' => 'Đang tiến hàng',
            ],[
                'status_name' => 'Vận chuyển',
            ],[
                'status_name' => 'Giao hàng',
            ],[
                'status_name' => 'Thành công',
            ],[
                'status_name' => 'Trả về',
            ],[
                'status_name' => 'Hủy bỏ',
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
        Schema::dropIfExists('mtb_status');
    }
}
