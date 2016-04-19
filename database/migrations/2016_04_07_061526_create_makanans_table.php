<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makanans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('nameMakanan')->unique();
            $table->String('slugMakanan')->unique();
            $table->string('descriptionMakanan');
            $table->decimal('priceMakanan');
            $table->string('imageMakanan');
            $table->string('thumbMakanan');
            $table->timestamps();

            // delete semua yang ada user_id
            // $table->foreign('user_id')
            //       ->references('id')
            //       ->on('users')
            //       ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('makanans');
    }
}
