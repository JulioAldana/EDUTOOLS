<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Guardian;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentEnrollmentSeeder extends Seeder
{
    /**
     * Ejecuta el seeder de alumnos, tutores e inscripciones.
     */
    public function run(): void
    {
        $studentsData = [
            [
                'student_code' => 'EST-2026-001',
                'first_name' => 'Carlos Alejandro',
                'last_name' => 'Méndez López',
                'birth_date' => '2012-04-18',
                'gender' => 'Masculino',
                'phone' => '5550-1001',
                'address' => 'Barrio El Centro, Puerto Barrios',
                'guardian' => [
                    'first_name' => 'María Fernanda',
                    'last_name' => 'López Ramírez',
                    'dpi' => '2458123690102',
                    'phone' => '5551-4401',
                    'address' => 'Barrio El Centro, Puerto Barrios',
                    'relationship' => 'Madre',
                ],
            ],
            [
                'student_code' => 'EST-2026-002',
                'first_name' => 'Andrea Sofía',
                'last_name' => 'Ramírez Castillo',
                'birth_date' => '2011-08-09',
                'gender' => 'Femenino',
                'phone' => '5550-1002',
                'address' => 'Colonia San Manuel, Morales',
                'guardian' => [
                    'first_name' => 'José Miguel',
                    'last_name' => 'Ramírez Pérez',
                    'dpi' => '1987456320102',
                    'phone' => '5551-4402',
                    'address' => 'Colonia San Manuel, Morales',
                    'relationship' => 'Padre',
                ],
            ],
            [
                'student_code' => 'EST-2026-003',
                'first_name' => 'Luis Fernando',
                'last_name' => 'García Morales',
                'birth_date' => '2010-11-22',
                'gender' => 'Masculino',
                'phone' => '5550-1003',
                'address' => 'Residenciales Las Palmas, Puerto Barrios',
                'guardian' => [
                    'first_name' => 'Claudia Patricia',
                    'last_name' => 'Morales Hernández',
                    'dpi' => '3012457890102',
                    'phone' => '5551-4403',
                    'address' => 'Residenciales Las Palmas, Puerto Barrios',
                    'relationship' => 'Madre',
                ],
            ],
            [
                'student_code' => 'EST-2026-004',
                'first_name' => 'Valeria Isabel',
                'last_name' => 'Hernández Soto',
                'birth_date' => '2012-02-14',
                'gender' => 'Femenino',
                'phone' => '5550-1004',
                'address' => 'Zona 1, Puerto Barrios',
                'guardian' => [
                    'first_name' => 'Rosa Elena',
                    'last_name' => 'Soto Aguilar',
                    'dpi' => '4123698740102',
                    'phone' => '5551-4404',
                    'address' => 'Zona 1, Puerto Barrios',
                    'relationship' => 'Madre',
                ],
            ],
            [
                'student_code' => 'EST-2026-005',
                'first_name' => 'Diego Armando',
                'last_name' => 'Pérez Caal',
                'birth_date' => '2009-06-30',
                'gender' => 'Masculino',
                'phone' => '5550-1005',
                'address' => 'Aldea Entre Ríos, Puerto Barrios',
                'guardian' => [
                    'first_name' => 'Mario Estuardo',
                    'last_name' => 'Pérez Choc',
                    'dpi' => '5236987410102',
                    'phone' => '5551-4405',
                    'address' => 'Aldea Entre Ríos, Puerto Barrios',
                    'relationship' => 'Padre',
                ],
            ],
            [
                'student_code' => 'EST-2026-006',
                'first_name' => 'Gabriela Alejandra',
                'last_name' => 'Castro Reyes',
                'birth_date' => '2011-12-05',
                'gender' => 'Femenino',
                'phone' => '5550-1006',
                'address' => 'Colonia El Manantial, Morales',
                'guardian' => [
                    'first_name' => 'Patricia Beatriz',
                    'last_name' => 'Reyes Gómez',
                    'dpi' => '6345872190102',
                    'phone' => '5551-4406',
                    'address' => 'Colonia El Manantial, Morales',
                    'relationship' => 'Madre',
                ],
            ],
        ];

        $grades = Grade::with('sections')->get();

        if ($grades->isEmpty()) {
            return;
        }

        foreach ($studentsData as $index => $studentData) {
            $guardianData = $studentData['guardian'];
            unset($studentData['guardian']);

            $student = Student::firstOrCreate(
                ['student_code' => $studentData['student_code']],
                $studentData + ['is_active' => true]
            );

            $guardian = Guardian::firstOrCreate(
                ['dpi' => $guardianData['dpi']],
                $guardianData + [
                    'user_id' => null,
                    'is_active' => true,
                ]
            );

            $guardian->students()->syncWithoutDetaching([
                $student->id => [
                    'is_primary' => true,
                ],
            ]);

            $grade = $grades[$index % $grades->count()];
            $section = $grade->sections->first();

            if ($section) {
                Enrollment::firstOrCreate(
                    [
                        'student_id' => $student->id,
                        'academic_year' => 2026,
                    ],
                    [
                        'grade_id' => $grade->id,
                        'section_id' => $section->id,
                        'enrollment_date' => '2026-01-10',
                        'status' => 'activo',
                    ]
                );
            }
        }
    }
}