<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChitietthuocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietthuoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('toathuoc_id')->unsigned();
            $table->integer('thuoc_id')->nullable()->unsigned();
            $table->text('tenthuoc');
            $table->text('dangthuoc');
            $table->integer('soluong');
            $table->integer('moingay');
            $table->integer('moilan');
            $table->text('buoi');
        });

        Schema::table('chitietthuoc', function($table) {
            $table->foreign('toathuoc_id')->references('id')->on('toathuoc');
            $table->foreign('thuoc_id')->references('id')->on('thuoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitietthuoc');
    }
}
