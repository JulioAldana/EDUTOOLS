<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla sections para registrar secciones por grado.
     */
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('grade_id')
                ->constrained('grades')
                ->restrictOnDelete();

            $table->string('name', 20);
            $table->integer('capacity')->default(30);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['grade_id', 'name']);
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla sections.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};