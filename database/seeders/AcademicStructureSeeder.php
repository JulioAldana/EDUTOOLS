<?php

namespace Database\Seeders;

use App\Models\AcademicCalendarEvent;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class AcademicStructureSeeder extends Seeder
{
    /**
     * Ejecuta el seeder de estructura académica base.
     */
    public function run(): void
    {
        /*
         |-----------------------------------------
         | Grados académicos
         |-----------------------------------------
         */
        $gradesData = [
            [
                'name' => 'Primero Básico',
                'level' => 'Nivel Medio',
                'description' => 'Primer grado del ciclo básico.',
            ],
            [
                'name' => 'Segundo Básico',
                'level' => 'Nivel Medio',
                'description' => 'Segundo grado del ciclo básico.',
            ],
            [
                'name' => 'Tercero Básico',
                'level' => 'Nivel Medio',
                'description' => 'Tercer grado del ciclo básico.',
            ],
            [
                'name' => 'Cuarto Bachillerato',
                'level' => 'Diversificado',
                'description' => 'Primer año de bachillerato.',
            ],
            [
                'name' => 'Quinto Bachillerato',
                'level' => 'Diversificado',
                'description' => 'Segundo año de bachillerato.',
            ],
        ];

        foreach ($gradesData as $gradeData) {
            Grade::firstOrCreate(
                [
                    'name' => $gradeData['name'],
                    'level' => $gradeData['level'],
                ],
                [
                    'description' => $gradeData['description'],
                    'is_active' => true,
                ]
            );
        }

        /*
         |-----------------------------------------
         | Secciones por grado
         |-----------------------------------------
         */
        $grades = Grade::all();

        foreach ($grades as $grade) {
            foreach (['A', 'B'] as $sectionName) {
                Section::firstOrCreate(
                    [
                        'grade_id' => $grade->id,
                        'name' => $sectionName,
                    ],
                    [
                        'capacity' => 30,
                        'is_active' => true,
                    ]
                );
            }
        }

        /*
         |-----------------------------------------
         | Docentes
         |-----------------------------------------
         */
        $teachersData = [
            [
                'teacher_code' => 'DOC-2026-001',
                'first_name' => 'María Fernanda',
                'last_name' => 'López Morales',
                'dpi' => '2458123690101',
                'phone' => '5551-2030',
                'email' => 'maria.lopez@edutools.test',
                'specialty' => 'Matemática',
                'hire_date' => '2022-01-15',
            ],
            [
                'teacher_code' => 'DOC-2026-002',
                'first_name' => 'Carlos Roberto',
                'last_name' => 'Méndez Castillo',
                'dpi' => '1987456320101',
                'phone' => '5552-9841',
                'email' => 'carlos.mendez@edutools.test',
                'specialty' => 'Comunicación y Lenguaje',
                'hire_date' => '2021-02-10',
            ],
            [
                'teacher_code' => 'DOC-2026-003',
                'first_name' => 'Ana Lucía',
                'last_name' => 'Ramírez Soto',
                'dpi' => '3012457890101',
                'phone' => '5553-6722',
                'email' => 'ana.ramirez@edutools.test',
                'specialty' => 'Ciencias Naturales',
                'hire_date' => '2023-03-01',
            ],
            [
                'teacher_code' => 'DOC-2026-004',
                'first_name' => 'Luis Fernando',
                'last_name' => 'García Pérez',
                'dpi' => '4123698740101',
                'phone' => '5554-1188',
                'email' => 'luis.garcia@edutools.test',
                'specialty' => 'Computación',
                'hire_date' => '2020-07-20',
            ],
        ];

        foreach ($teachersData as $teacherData) {
            Teacher::firstOrCreate(
                ['teacher_code' => $teacherData['teacher_code']],
                $teacherData + ['is_active' => true]
            );
        }

        /*
         |-----------------------------------------
         | Cursos por grado
         |-----------------------------------------
         */
        $teachers = Teacher::all();

        $coursesByGrade = [
            'Matemática',
            'Comunicación y Lenguaje',
            'Ciencias Naturales',
            'Estudios Sociales',
            'Computación',
        ];

        foreach ($grades as $grade) {
            foreach ($coursesByGrade as $index => $courseName) {
                $teacher = $teachers[$index % $teachers->count()];

                Course::firstOrCreate(
                    [
                        'grade_id' => $grade->id,
                        'name' => $courseName,
                    ],
                    [
                        'teacher_id' => $teacher->id,
                        'code' => 'CUR-' . $grade->id . '-' . str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT),
                        'description' => $courseName . ' para ' . $grade->name,
                        'weekly_hours' => 5,
                        'is_active' => true,
                    ]
                );
            }
        }

        /*
         |-----------------------------------------
         | Calendario académico
         |-----------------------------------------
         */
        $eventsData = [
            [
                'title' => 'Inicio del ciclo escolar 2026',
                'description' => 'Inicio oficial de clases para todos los niveles.',
                'event_date' => '2026-01-15',
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'event_type' => 'actividad',
            ],
            [
                'title' => 'Primera reunión con padres de familia',
                'description' => 'Presentación del plan académico y normas internas.',
                'event_date' => '2026-02-05',
                'start_time' => '15:00:00',
                'end_time' => '17:00:00',
                'event_type' => 'reunion',
            ],
            [
                'title' => 'Evaluaciones de primera unidad',
                'description' => 'Semana de evaluaciones correspondiente a la primera unidad.',
                'event_date' => '2026-03-18',
                'start_time' => null,
                'end_time' => null,
                'event_type' => 'examen',
            ],
            [
                'title' => 'Actividad cívica institucional',
                'description' => 'Actividad cultural y cívica con participación estudiantil.',
                'event_date' => '2026-09-14',
                'start_time' => '08:00:00',
                'end_time' => '11:00:00',
                'event_type' => 'actividad',
            ],
        ];

        foreach ($eventsData as $eventData) {
            AcademicCalendarEvent::firstOrCreate(
                [
                    'title' => $eventData['title'],
                    'event_date' => $eventData['event_date'],
                ],
                $eventData + ['is_active' => true]
            );
        }
    }
}