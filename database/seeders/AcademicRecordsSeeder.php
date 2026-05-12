<?php

namespace Database\Seeders;

use App\Models\AttendanceRecord;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\GradeRecord;
use Illuminate\Database\Seeder;

class AcademicRecordsSeeder extends Seeder
{
    /**
     * Ejecuta el seeder de notas y asistencia.
     */
    public function run(): void
    {
        $enrollments = Enrollment::with('student')->get();
        $courses = Course::with('teacher')->get();

        if ($enrollments->isEmpty() || $courses->isEmpty()) {
            return;
        }

        /*
         |-----------------------------------------
         | Registro de notas
         |-----------------------------------------
         */
        $terms = [
            'Primera unidad',
            'Segunda unidad',
        ];

        $evaluationTypes = [
            'Tarea',
            'Examen parcial',
            'Proyecto',
        ];

        foreach ($enrollments as $enrollmentIndex => $enrollment) {
            $studentCourses = $courses
                ->where('grade_id', $enrollment->grade_id)
                ->take(3);

            foreach ($studentCourses as $courseIndex => $course) {
                foreach ($terms as $termIndex => $term) {
                    foreach ($evaluationTypes as $evaluationIndex => $evaluationType) {
                        $score = 70 + (($enrollmentIndex + $courseIndex + $termIndex + $evaluationIndex) % 28);

                        GradeRecord::firstOrCreate(
                            [
                                'student_id' => $enrollment->student_id,
                                'course_id' => $course->id,
                                'academic_year' => 2026,
                                'term' => $term,
                                'evaluation_type' => $evaluationType,
                            ],
                            [
                                'teacher_id' => $course->teacher_id,
                                'score' => $score,
                                'max_score' => 100,
                                'comments' => 'Registro académico generado como dato de prueba realista.',
                            ]
                        );
                    }
                }
            }
        }

        /*
         |-----------------------------------------
         | Registro de asistencia
         |-----------------------------------------
         */
        $attendanceDates = [
            '2026-02-03',
            '2026-02-04',
            '2026-02-05',
            '2026-02-06',
            '2026-02-09',
        ];

        $statuses = [
            'presente',
            'presente',
            'presente',
            'tarde',
            'ausente',
            'justificado',
        ];

        foreach ($enrollments as $enrollmentIndex => $enrollment) {
            $studentCourses = $courses
                ->where('grade_id', $enrollment->grade_id)
                ->take(3);

            foreach ($studentCourses as $courseIndex => $course) {
                foreach ($attendanceDates as $dateIndex => $attendanceDate) {
                    $status = $statuses[($enrollmentIndex + $courseIndex + $dateIndex) % count($statuses)];

                    AttendanceRecord::firstOrCreate(
                        [
                            'student_id' => $enrollment->student_id,
                            'course_id' => $course->id,
                            'attendance_date' => $attendanceDate,
                        ],
                        [
                            'teacher_id' => $course->teacher_id,
                            'status' => $status,
                            'comments' => $status === 'presente'
                                ? null
                                : 'Registro generado como dato de prueba para control de asistencia.',
                        ]
                    );
                }
            }
        }
    }
}