<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\GradeRecord;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GradeRecordController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $gradeRecords = GradeRecord::query()
            ->with(['student', 'course', 'teacher'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('academic_year', 'like', "%{$search}%")
                    ->orWhere('term', 'like', "%{$search}%")
                    ->orWhere('evaluation_type', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
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
            ->orderByDesc('academic_year')
            ->orderBy('term')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.grade-records.index', compact('gradeRecords', 'search'));
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

        return view('admin.grade-records.create', compact('students', 'courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'academic_year' => ['required', 'integer', 'min:2020', 'max:2100'],
            'term' => ['required', 'string', 'max:50'],
            'evaluation_type' => ['required', 'string', 'max:80'],
            'score' => ['required', 'numeric', 'min:0', 'max:999.99'],
            'max_score' => ['required', 'numeric', 'min:1', 'max:999.99'],
            'comments' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['activo', 'anulado'])],
        ], [
            'student_id.required' => 'El alumno es obligatorio.',
            'student_id.exists' => 'El alumno seleccionado no existe.',
            'course_id.required' => 'El curso es obligatorio.',
            'course_id.exists' => 'El curso seleccionado no existe.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
            'academic_year.required' => 'El ciclo escolar es obligatorio.',
            'term.required' => 'El período o bimestre es obligatorio.',
            'evaluation_type.required' => 'El tipo de evaluación es obligatorio.',
            'score.required' => 'La nota obtenida es obligatoria.',
            'score.numeric' => 'La nota obtenida debe ser numérica.',
            'max_score.required' => 'La nota máxima es obligatoria.',
            'max_score.numeric' => 'La nota máxima debe ser numérica.',
            'status.required' => 'El estado de la nota es obligatorio.',
        ]);

        if ((float) $validated['score'] > (float) $validated['max_score']) {
            return back()
                ->withErrors(['score' => 'La nota obtenida no puede ser mayor que la nota máxima.'])
                ->withInput();
        }

        GradeRecord::create($validated);

        return redirect()
            ->route('grade-records.index')
            ->with('success', 'Nota registrada correctamente.');
    }

    public function show(GradeRecord $gradeRecord)
    {
        $gradeRecord->load(['student', 'course', 'teacher']);

        return view('admin.grade-records.show', compact('gradeRecord'));
    }

    public function edit(GradeRecord $gradeRecord)
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

        return view('admin.grade-records.edit', compact('gradeRecord', 'students', 'courses', 'teachers'));
    }

    public function update(Request $request, GradeRecord $gradeRecord)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'academic_year' => ['required', 'integer', 'min:2020', 'max:2100'],
            'term' => ['required', 'string', 'max:50'],
            'evaluation_type' => ['required', 'string', 'max:80'],
            'score' => ['required', 'numeric', 'min:0', 'max:999.99'],
            'max_score' => ['required', 'numeric', 'min:1', 'max:999.99'],
            'comments' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['activo', 'anulado'])],
        ], [
            'student_id.required' => 'El alumno es obligatorio.',
            'student_id.exists' => 'El alumno seleccionado no existe.',
            'course_id.required' => 'El curso es obligatorio.',
            'course_id.exists' => 'El curso seleccionado no existe.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
            'academic_year.required' => 'El ciclo escolar es obligatorio.',
            'term.required' => 'El período o bimestre es obligatorio.',
            'evaluation_type.required' => 'El tipo de evaluación es obligatorio.',
            'score.required' => 'La nota obtenida es obligatoria.',
            'score.numeric' => 'La nota obtenida debe ser numérica.',
            'max_score.required' => 'La nota máxima es obligatoria.',
            'max_score.numeric' => 'La nota máxima debe ser numérica.',
            'status.required' => 'El estado de la nota es obligatorio.',
        ]);

        if ((float) $validated['score'] > (float) $validated['max_score']) {
            return back()
                ->withErrors(['score' => 'La nota obtenida no puede ser mayor que la nota máxima.'])
                ->withInput();
        }

        $gradeRecord->update($validated);

        return redirect()
            ->route('grade-records.index')
            ->with('success', 'Nota actualizada correctamente.');
    }

    public function destroy(GradeRecord $gradeRecord)
    {
        $gradeRecord->update([
            'status' => 'anulado',
        ]);

        return redirect()
            ->route('grade-records.index')
            ->with('success', 'Nota anulada correctamente.');
    }
}