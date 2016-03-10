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
            $table->integer('fixation_duration');
            $table->integer('fixation_count');
            $table->integer('left_pupil_size');
            $table->integer('right_pupil_size');
            $table->integer('waight');
            $table->string('class');
            $table->string('url');
            $table->integer('participant_id')->unsigned();
            $table->foreign('participant_id')->references('id')->on('participants');
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
