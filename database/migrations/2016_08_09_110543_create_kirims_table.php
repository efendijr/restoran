<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKirimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kirims', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bayar_id')->unsigned();
            $table->integer('alamat_id')->unsigned();
            $table->string('statusKirim');
            $table->timestamps();

            $table->foreign('bayar_id')->references('id')->on('bayars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kirims');
    }
}
