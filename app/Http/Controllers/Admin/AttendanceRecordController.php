<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceRecord;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceRecordController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $attendanceRecords = AttendanceRecord::query()
            ->with(['student', 'course', 'teacher'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('attendance_date', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('comments', 'like', "%{$search}%")
                    ->orWhereHas('student', function ($studentQuery) use ($search) {
                        $studentQuery->where('student_code', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('course', function ($courseQuery) use ($search) {
                        $courseQuery->where('code', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('teacher', function ($teacherQuery) use ($search) {
                        $teacherQuery->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            })
            ->orderByDesc('attendance_date')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.attendance-records.index', compact('attendanceRecords', 'search'));
    }

    public function create()
    {
        $students = Student::query()
            ->where('is_active', true)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $courses = Course::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('admin.attendance-records.create', compact('students', 'courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'attendance_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['presente', 'ausente', 'tarde', 'justificado', 'anulado'])],
            'comments' => ['nullable', 'string'],
        ], [
            'student_id.required' => 'El alumno es obligatorio.',
            'student_id.exists' => 'El alumno seleccionado no existe.',
            'course_id.required' => 'El curso es obligatorio.',
            'course_id.exists' => 'El curso seleccionado no existe.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
            'attendance_date.required' => 'La fecha de asistencia es obligatoria.',
            'attendance_date.date' => 'La fecha de asistencia no es válida.',
            'status.required' => 'El estado de asistencia es obligatorio.',
        ]);

        AttendanceRecord::create($validated);

        return redirect()
            ->route('attendance-records.index')
            ->with('success', 'Asistencia registrada correctamente.');
    }

    public function show(AttendanceRecord $attendanceRecord)
    {
        $attendanceRecord->load(['student', 'course', 'teacher']);

        return view('admin.attendance-records.show', compact('attendanceRecord'));
    }

    public function edit(AttendanceRecord $attendanceRecord)
    {
        $students = Student::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $courses = Course::query()
            ->orderBy('name')
            ->get();

        $teachers = Teacher::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('admin.attendance-records.edit', compact('attendanceRecord', 'students', 'courses', 'teachers'));
    }

    public function update(Request $request, AttendanceRecord $attendanceRecord)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'attendance_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['presente', 'ausente', 'tarde', 'justificado', 'anulado'])],
            'comments' => ['nullable', 'string'],
        ], [
            'student_id.required' => 'El alumno es obligatorio.',
            'student_id.exists' => 'El alumno seleccionado no existe.',
            'course_id.required' => 'El curso es obligatorio.',
            'course_id.exists' => 'El curso seleccionado no existe.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
            'attendance_date.required' => 'La fecha de asistencia es obligatoria.',
            'attendance_date.date' => 'La fecha de asistencia no es válida.',
            'status.required' => 'El estado de asistencia es obligatorio.',
        ]);

        $attendanceRecord->update($validated);

        return redirect()
            ->route('attendance-records.index')
            ->with('success', 'Asistencia actualizada correctamente.');
    }

    public function destroy(AttendanceRecord $attendanceRecord)
    {
        $attendanceRecord->update([
            'status' => 'anulado',
        ]);

        return redirect()
            ->route('attendance-records.index')
            ->with('success', 'Asistencia anulada correctamente.');
    }
}