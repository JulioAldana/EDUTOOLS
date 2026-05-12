<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega las columnas faltantes a la tabla grades.
     */
    public function up(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->string('name', 100)->after('id');
            $table->string('level', 100)->after('name');
            $table->text('description')->nullable()->after('level');
            $table->boolean('is_active')->default(true)->after('description');

            $table->unique(['name', 'level']);
        });
    }

    /**
     * Revierte las columnas agregadas.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropUnique(['name', 'level']);

            $table->dropColumn([
                'name',
                'level',
                'description',
                'is_active',
            ]);
        });
    }
};