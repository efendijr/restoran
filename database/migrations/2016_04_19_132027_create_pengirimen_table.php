<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengirimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengirimen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->unsigned()->index();
            $table->integer('admin_id')->unsigned()->index();
            $table->string('nameReceiver');
            $table->string('addressReceiver');
            $table->string('phoneReceiver');
            $table->string('statusDelivery');
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
        Schema::drop('pengirimen');
    }
}
