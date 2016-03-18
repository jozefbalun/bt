<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->increments('id');
            $table->string('word');
            $table->decimal('fixation_duration', 10, 2);
            $table->integer('fixation_count');
            $table->decimal('left_pupil_size', 16, 16);
            $table->decimal('right_pupil_size', 16, 16);
            $table->decimal('weight', 10, 6);
            $table->string('class');
            $table->string('parent_element');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks');
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
        Schema::drop('words');
    }
}
