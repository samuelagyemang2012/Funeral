<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFuneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funerals', function (Blueprint $table) {

//            $table->string('longitude')->change();
//            $table->string('latitude')->change();
//            $table->string('date')->change();
            $table->string('time');
//            $table->string('wake_keeping_date')->default("none")->change();
            $table->string('wake_keeping_time')->default("none");
//            $table->string('wake_keeping_location')->default("none");
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
