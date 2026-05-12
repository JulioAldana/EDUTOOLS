<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla grades para registrar grados académicos.
     */
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('level', 100);

            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['name', 'level']);
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla grades.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};