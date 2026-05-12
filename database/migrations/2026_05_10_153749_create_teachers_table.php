<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla teachers para registrar docentes.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('teacher_code', 20)->unique();

            $table->string('first_name', 100);
            $table->string('last_name', 100);

            $table->string('dpi', 20)->nullable()->unique();
            $table->string('phone', 25)->nullable();
            $table->string('email', 150)->nullable()->unique();

            $table->string('specialty', 100)->nullable();
            $table->date('hire_date')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla teachers.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};