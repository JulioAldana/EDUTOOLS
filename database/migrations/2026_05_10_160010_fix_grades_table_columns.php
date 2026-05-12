<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Corrige la tabla grades agregando columnas faltantes.
     */
    public function up(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            if (!Schema::hasColumn('grades', 'name')) {
                $table->string('name', 100)->after('id');
            }

            if (!Schema::hasColumn('grades', 'level')) {
                $table->string('level', 100)->after('name');
            }

            if (!Schema::hasColumn('grades', 'description')) {
                $table->text('description')->nullable()->after('level');
            }

            if (!Schema::hasColumn('grades', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('description');
            }
        });
    }

    /**
     * No se eliminan columnas para evitar pérdida accidental de datos.
     */
    public function down(): void
    {
        //
    }
};