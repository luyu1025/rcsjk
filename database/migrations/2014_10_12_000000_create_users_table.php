<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('head')->default('http://www.lsecret.cn/img/user/head.jpg');
            $table->string('bgp')->default('http://www.lsecret.cn/img/user/bg.jpg');
            $table->enum('auth',['0','1','2','3'])->default('0');
            $table->enum('sex',['0','1'])->default('1');  //0:女 1：男
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
        Schema::dropIfExists('users');
    }
}
