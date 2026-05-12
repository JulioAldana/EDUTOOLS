<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla enrollments para registrar inscripciones.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->restrictOnDelete();

            $table->foreignId('grade_id')
                ->constrained('grades')
                ->restrictOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->restrictOnDelete();

            $table->year('academic_year');
            $table->date('enrollment_date');

            $table->string('status', 30)->default('activo');

            $table->timestamps();

            $table->unique(['student_id', 'academic_year']);
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla enrollments.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};