<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->integer('question_id');
            $table->integer('answer_id')->nullable();
            $table->integer('question_number');
            $table->integer('time')->nullable();
            $table->integer('score')->default(0);
            $table->boolean('is_answer')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_details');
    }
};
