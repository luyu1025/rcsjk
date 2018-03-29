<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->default("");
            $table->string('user')->nullable();
            $table->string('abs')->nullable();
            $table->text('content')->nullable();
            $table->string('img',100)->nullable();
            $table->integer('user_id')->default(0);
            $table->enum('type',['share','new'])->default('new');
            $table->enum('status',['0','1','2'])->default('0');//0:编辑中  1：未发布   2：已发布
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
        Schema::dropIfExists('posts');
    }
}
