<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla grade_records para registrar notas de alumnos.
     */
    public function up(): void
    {
        Schema::create('grade_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->restrictOnDelete();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->restrictOnDelete();

            $table->foreignId('teacher_id')
                ->nullable()
                ->constrained('teachers')
                ->nullOnDelete();

            $table->year('academic_year');

            $table->string('term', 50);
            $table->string('evaluation_type', 80)->default('Actividad');

            $table->decimal('score', 5, 2);
            $table->decimal('max_score', 5, 2)->default(100);

            $table->text('comments')->nullable();

            $table->timestamps();

            $table->unique([
                'student_id',
                'course_id',
                'academic_year',
                'term',
                'evaluation_type'
            ], 'grade_records_unique_evaluation');
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla grade_records.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_records');
    }
};