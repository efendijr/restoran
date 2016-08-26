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
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('nameMakanan')->unique();
            $table->String('slugMakanan')->unique();
            $table->string('descriptionMakanan');
            $table->decimal('priceMakanan');
            $table->decimal('diskonMakanan');
            $table->decimal('lastPriceMakanan');
            $table->string('imageMakanan');
            $table->string('thumbMakanan');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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
