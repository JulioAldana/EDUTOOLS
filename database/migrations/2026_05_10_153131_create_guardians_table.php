<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla guardians para registrar padres o tutores.
     */
    public function up(): void
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('first_name', 100);
            $table->string('last_name', 100);

            $table->string('dpi', 20)->nullable()->unique();
            $table->string('phone', 25);
            $table->string('address', 255)->nullable();

            $table->string('relationship', 50);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla guardians si se hace rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};