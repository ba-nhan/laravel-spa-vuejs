<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoicongtacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noicongtac', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('tinh_id')->nullable()->unsigned();
        });
        Schema::table('noicongtac', function($table) {
            $table->foreign('tinh_id')->references('id')->on('tinh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noicongtac');
    }
}
