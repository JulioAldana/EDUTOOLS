<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla academic_calendar_events para registrar eventos académicos.
     */
    public function up(): void
    {
        Schema::create('academic_calendar_events', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150);
            $table->text('description')->nullable();

            $table->date('event_date');

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->string('event_type', 50);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla academic_calendar_events.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_calendar_events');
    }
};