<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendarEvent;
use App\Models\AttendanceRecord;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\GradeRecord;
use App\Models\Guardian;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'students' => Student::count(),
            'active_students' => Student::where('is_active', true)->count(),

            'guardians' => Guardian::count(),
            'active_guardians' => Guardian::where('is_active', true)->count(),

            'teachers' => Teacher::count(),
            'active_teachers' => Teacher::where('is_active', true)->count(),

            'courses' => Course::count(),
            'active_courses' => Course::where('is_active', true)->count(),

            'grades' => Grade::count(),
            'active_grades' => Grade::where('is_active', true)->count(),

            'sections' => Section::count(),
            'active_sections' => Section::where('is_active', true)->count(),

            'users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),

            'enrollments' => Enrollment::count(),
            'active_enrollments' => Enrollment::where('status', 'activo')->count(),

            'grade_records' => GradeRecord::count(),
            'active_grade_records' => GradeRecord::where('status', 'activo')->count(),

            'attendance_records' => AttendanceRecord::count(),

            'calendar_events' => AcademicCalendarEvent::count(),
            'active_calendar_events' => AcademicCalendarEvent::where('is_active', true)->count(),
        ];

        $chartData = [
            'labels' => [
                'Alumnos',
                'Tutores',
                'Docentes',
                'Cursos',
                'Inscripciones',
                'Notas',
                'Asistencias',
                'Eventos',
            ],
            'values' => [
                $stats['active_students'],
                $stats['active_guardians'],
                $stats['active_teachers'],
                $stats['active_courses'],
                $stats['active_enrollments'],
                $stats['active_grade_records'],
                $stats['attendance_records'],
                $stats['active_calendar_events'],
            ],
        ];

        $latestEnrollments = Enrollment::query()
            ->with(['student', 'grade', 'section'])
            ->latest()
            ->take(5)
            ->get();

        $latestGradeRecords = GradeRecord::query()
            ->with(['student', 'course'])
            ->latest()
            ->take(5)
            ->get();

        $latestAttendanceRecords = AttendanceRecord::query()
            ->with(['student', 'course'])
            ->latest()
            ->take(5)
            ->get();

        $upcomingEvents = AcademicCalendarEvent::query()
            ->where('is_active', true)
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'stats',
            'chartData',
            'latestEnrollments',
            'latestGradeRecords',
            'latestAttendanceRecords',
            'upcomingEvents'
        ));
    }
}