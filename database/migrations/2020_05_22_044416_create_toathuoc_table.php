<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToathuocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toathuoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phieukham_id')->unique()->unsigned();
            $table->text('chuandoan');
            $table->text('loidan')->nullable();
            $table->datetime('taikham')->nullable();
            $table->datetime('thoigiandt')->unique();
        });
        Schema::table('toathuoc', function($table) {
            $table->foreign('phieukham_id')->references('id')->on('phieukham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toathuoc');
    }
}
