<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvedusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvedus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cv_id')->default(0);
            $table->string('school')->default('');
            $table->enum('degree',['0','1','2','3','4','5','6']);   //0：无 1：小学 2：初中 3：高中 4：学士 5：硕士 6：博士
            $table->dateTimeTz('start_time');
            $table->dateTimeTz('end_time');
            $table->text('other');
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
        Schema::dropIfExists('cvedus');
    }
}
