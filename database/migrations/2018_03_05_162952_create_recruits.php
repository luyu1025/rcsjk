<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruits', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['0','1'])->default('0');
            $table->integer('user_id')->default(0);
            $table->string('title')->default('无题');
            $table->string('name')->default('佚名');
            $table->text('context');
            $table->text('requirement');
            $table->time('endTime');
            $table->integer('num')->default(0);
            $table->integer('all')->default(1);
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
        Schema::dropIfExists('recruits');
    }
}
