<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhongkhamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phongkham', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();
            $table->string('tencs');
            $table->string('ngaycp');
            $table->string('tenbs');
            $table->string('nsbs');
            $table->string('gioitinhbs');
            $table->integer('trinhdo_id')->unsigned();
            $table->integer('chuyenkhoa_id')->unsigned();
            $table->integer('noicongtac_id')->unsigned();
            $table->text('diachi');
            $table->text('iframe_map')->nullable();
            $table->string('vido')->nullable();
            $table->string('kinhdo')->nullable();
            $table->string('sodtpk');
            $table->integer('khung1_id')->unsigned();
            $table->integer('khung2_id')->nullable()->unsigned();
            $table->integer('khung3_id')->nullable()->unsigned();
            $table->integer('timetb');
            $table->integer('layout');
            // $table->timestamps();
        });
        Schema::table('phongkham', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('trinhdo_id')->references('id')->on('trinhdo');
            $table->foreign('chuyenkhoa_id')->references('id')->on('chuyenkhoa');
            $table->foreign('noicongtac_id')->references('id')->on('noicongtac');
            $table->foreign('khung1_id')->references('id')->on('khungthoigian');
            $table->foreign('khung2_id')->references('id')->on('khungthoigian');
            $table->foreign('khung3_id')->references('id')->on('khungthoigian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phongkham');
    }
}
