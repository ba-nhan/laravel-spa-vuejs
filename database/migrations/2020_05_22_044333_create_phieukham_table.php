<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieukhamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieukham', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('thoigian')->unique();
            $table->integer('phongkham_id')->unsigned();
            $table->integer('benhnhan_id')->unsigned();
            $table->integer('khungtime_id')->unsigned();
            $table->integer('sokb');
        });
        Schema::table('phieukham', function($table) {
            $table->foreign('phongkham_id')->references('id')->on('phongkham');
            $table->foreign('benhnhan_id')->references('id')->on('benhnhan');
            $table->foreign('khungtime_id')->references('id')->on('khungthoigian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieukham');
    }
}
