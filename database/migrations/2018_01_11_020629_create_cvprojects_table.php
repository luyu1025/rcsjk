<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvprojectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvprojects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cv_id')->default(0);
            $table->string('name')->default('');
            $table->string('duty');
            $table->string('url');
            $table->dateTimeTz('start_time');
            $table->dateTimeTz('end_time');
            $table->text('introduce');
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
        Schema::dropIfExists('cvprojects');
    }
}
