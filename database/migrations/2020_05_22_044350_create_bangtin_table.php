<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBangtinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangtin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phongkham_id')->unsigned();
            $table->string('tieude');
            $table->text('noidung');
            $table->datetime('thoigian');
        });
        Schema::table('bangtin', function($table) {
            $table->foreign('phongkham_id')->references('id')->on('phongkham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bangtin');
    }
}
