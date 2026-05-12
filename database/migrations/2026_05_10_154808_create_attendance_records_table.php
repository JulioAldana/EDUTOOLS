<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla attendance_records para registrar asistencia.
     */
    public function up(): void
    {
        Schema::create('attendance_records', function (Blueprint $table) {
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

            $table->date('attendance_date');

            $table->string('status', 30)->default('presente');

            $table->text('comments')->nullable();

            $table->timestamps();

            $table->unique([
                'student_id',
                'course_id',
                'attendance_date'
            ], 'attendance_unique_student_course_date');
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla attendance_records.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};