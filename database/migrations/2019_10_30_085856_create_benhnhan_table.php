<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenhnhanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benhnhan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();
            $table->string('tenbn');
            $table->string('gioitinhbn');
            $table->date('namsinhbn');
            $table->string('sodtbn');
            $table->string('socmbn')->unique();
            $table->text('diachibn');
            // $table->timestamps();
        });
        Schema::table('benhnhan', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benhnhan');
    }
}
