<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id('question_id');
            $table->enum('category', ['TKP', 'TIU', 'TWK']);
            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('sub_category_id')->on('sub_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('question_image_url')->nullable();
            $table->string('question_text');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('exam_type', ['Simulasi', 'Test']);
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
