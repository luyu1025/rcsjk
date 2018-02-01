<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvexpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvexps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cv_id')->default(0);
            $table->string('company')->default('');
            $table->integer('job_id');
            $table->dateTimeTz('start_time');
            $table->dateTimeTz('end_time');
            $table->text('experience');
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
        Schema::dropIfExists('cvexps');
    }
}
