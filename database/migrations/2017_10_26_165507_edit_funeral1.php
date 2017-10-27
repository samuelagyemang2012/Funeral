<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFuneral1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funerals', function (Blueprint $table) {

//            $table->string('wake_keeping_date')->default("none")->change();
//            $table->string('wake_keeping_time')->default("none");
            $table->string('wake_keeping_location')->default("none")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
