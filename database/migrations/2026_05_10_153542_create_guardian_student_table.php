<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla intermedia entre tutores y alumnos.
     */
    public function up(): void
    {
        Schema::create('guardian_student', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guardian_id')
                ->constrained('guardians')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->boolean('is_primary')->default(false);

            $table->timestamps();

            $table->unique(['guardian_id', 'student_id']);
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla guardian_student.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardian_student');
    }
};