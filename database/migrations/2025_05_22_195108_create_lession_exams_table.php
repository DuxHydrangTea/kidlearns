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
        Schema::create('lesson_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('set')->default(1);
            $table->unsignedBigInteger('lesson_id');
            $table->string('content')->nullable();
            $table->text('answers')->nullable();
            $table->tinyInteger('correct_answer')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lession_exams');
    }
};
