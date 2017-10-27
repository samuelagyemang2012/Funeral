<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funerals', function (Blueprint $table) {
            $table->increments('fid');
            $table->integer('user_id');
            $table->string('name');
            $table->string('deceased_name');
            $table->string('deceased_age');
            $table->string('information');
            $table->string('brochure');
            $table->string('funeral_location');
            $table->decimal('longitude');
            $table->decimal('latitude');
            $table->string('attire');
            $table->dateTime('date');
            $table->integer('wake_keeping');
            $table->dateTime('wake_keeping_date');
            $table->string('wake_keeping_location');
            $table->timestamps();
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
