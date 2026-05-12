<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('grade_records', function (Blueprint $table) {
            if (! Schema::hasColumn('grade_records', 'status')) {
                $table->string('status', 30)->default('activo')->after('comments');
            }
        });
    }

    public function down(): void
    {
        Schema::table('grade_records', function (Blueprint $table) {
            if (Schema::hasColumn('grade_records', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};