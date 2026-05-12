<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla students para registrar alumnos.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('student_code', 20)->unique();

            $table->string('first_name', 100);
            $table->string('last_name', 100);

            $table->date('birth_date')->nullable();
            $table->string('gender', 20)->nullable();

            $table->string('phone', 25)->nullable();
            $table->string('address', 255)->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla students si se hace rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};