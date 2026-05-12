<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta todos los seeders principales del proyecto EDUTOOLS.
     */
    public function run(): void
    {
        $this->call([
            AcademicStructureSeeder::class,
            StudentEnrollmentSeeder::class,
            AcademicRecordsSeeder::class,
            DemoAccessSeeder::class,
        ]);
    }
}