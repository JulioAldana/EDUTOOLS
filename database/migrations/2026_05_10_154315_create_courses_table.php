<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla courses para registrar cursos académicos.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('grade_id')
                ->constrained('grades')
                ->restrictOnDelete();

            $table->foreignId('teacher_id')
                ->nullable()
                ->constrained('teachers')
                ->nullOnDelete();

            $table->string('code', 20)->unique();
            $table->string('name', 120);

            $table->text('description')->nullable();
            $table->integer('weekly_hours')->default(5);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['grade_id', 'name']);
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla courses.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};