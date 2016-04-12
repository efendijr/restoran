<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warungs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameWarung')->unique();
            $table->string('descriptionWarung');
            $table->string('addressWarung');
            $table->string('aliasWarung')->unique();
            $table->string('password');
            $table->decimal('depositeWarung');
            $table->string('logoWarung');
            $table->string('thumbWarung');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('warungs');
    }
}
