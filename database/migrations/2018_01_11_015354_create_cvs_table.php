<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->integer('user_id');
            $table->string('user_name',100);
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->string('head');
            $table->enum('sex',['0','1'])->default('1');  //0:女 1：男
            $table->string('ethnic',100);
            $table->enum('identity',['0','1','2']);   //0：群众   1：共青团员   2：中共党员
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
        Schema::dropIfExists('cvs');
    }
}
