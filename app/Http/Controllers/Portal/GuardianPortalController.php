<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendarEvent;
use App\Models\AttendanceRecord;
use App\Models\Enrollment;
use App\Models\GradeRecord;
use App\Models\Guardian;
use App\Models\Student;

class GuardianPortalController extends Controller
{
    private function currentGuardian(): Guardian
    {
        $guardian = auth()->user()
            ->guardian()
            ->with('students')
            ->first();

        if (! $guardian) {
            abort(403, 'Tu usuario no está vinculado a un padre o tutor registrado.');
        }

        return $guardian;
    }

    public function dashboard()
    {
        $guardian = $this->currentGuardian();

        $studentIds = $guardian->students->pluck('id');

        $recentGrades = GradeRecord::query()
            ->with(['student', 'course'])
            ->whereIn('student_id', $studentIds)
            ->where('status', 'activo')
            ->orderByDesc('created_at')
            ->take(8)
            ->get();

        $recentAttendance = AttendanceRecord::query()
            ->with(['student', 'course'])
            ->whereIn('student_id', $studentIds)
            ->orderByDesc('attendance_date')
            ->take(8)
            ->get();

        $upcomingEvents = AcademicCalendarEvent::query()
            ->where('is_active', true)
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        return view('portal.dashboard', compact(
            'guardian',
            'recentGrades',
            'recentAttendance',
            'upcomingEvents'
        ));
    }

    public function showStudent(Student $student)
    {
        $guardian = $this->currentGuardian();

        $isLinked = $guardian->students()
            ->where('students.id', $student->id)
            ->exists();

        if (! $isLinked) {
            abort(403, 'No tienes permiso para ver la información de este alumno.');
        }

        $enrollments = Enrollment::query()
            ->with(['grade', 'section'])
            ->where('student_id', $student->id)
            ->orderByDesc('academic_year')
            ->get();

        $grades = GradeRecord::query()
            ->with(['course', 'teacher'])
            ->where('student_id', $student->id)
            ->orderByDesc('academic_year')
            ->orderBy('term')
            ->get();

        $attendanceRecords = AttendanceRecord::query()
            ->with(['course', 'teacher'])
            ->where('student_id', $student->id)
            ->orderByDesc('attendance_date')
            ->take(30)
            ->get();

        return view('portal.students.show', compact(
            'guardian',
            'student',
            'enrollments',
            'grades',
            'attendanceRecords'
        ));
    }

    public function calendar()
    {
        $guardian = $this->currentGuardian();

        $events = AcademicCalendarEvent::query()
            ->where('is_active', true)
            ->orderByDesc('event_date')
            ->paginate(10);

        return view('portal.calendar.index', compact('guardian', 'events'));
    }
}