<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->text('description')->nullable();
            $table->char('time', 4);
            $table->string('after_answer')->nullable();
            $table->integer("point");
            $table->unsignedInteger('created_by')->nullable();
            $table->foreign('created_by')->references("id")->on("users")->onDelete('cascade');
            $table->unsignedInteger('question_type_id');
            $table->foreign('question_type_id')->references("id")->on("question_types")->onDelete('cascade');
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
        Schema::dropIfExists('questions');
    }
}
