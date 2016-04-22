<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameMember');
            $table->string('emailMember')->unique();
            $table->string('usernameMember')->unique();
            $table->string('password');
            $table->string('addressMember');
            $table->string('phoneMember');
            $table->decimal('depositeMember');
            $table->string('imageMember');
            $table->string('thumbMember');
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
        Schema::drop('members');
    }
}
