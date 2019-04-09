<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_correct');
            $table->unsignedInteger('choice_id');
            $table->foreign('choice_id')->references("id")->on("choices")->onDelete('cascade');
            $table->unsignedInteger('question_id');
            $table->foreign('question_id')->references("id")->on("questions")->onDelete('cascade');
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
        Schema::dropIfExists('questions_choices');
    }
}