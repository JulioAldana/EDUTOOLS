<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $enrollments = Enrollment::query()
            ->with(['student', 'grade', 'section'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('academic_year', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('student', function ($studentQuery) use ($search) {
                        $studentQuery->where('student_code', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('grade', function ($gradeQuery) use ($search) {
                        $gradeQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('level', 'like', "%{$search}%");
                    })
                    ->orWhereHas('section', function ($sectionQuery) use ($search) {
                        $sectionQuery->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderByDesc('academic_year')
            ->orderByDesc('enrollment_date')
            ->paginate(10)
            ->withQueryString();

        return view('admin.enrollments.index', compact('enrollments', 'search'));
    }

    public function create()
    {
        $students = Student::query()
            ->where('is_active', true)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $grades = Grade::query()
            ->where('is_active', true)
            ->orderBy('level')
            ->orderBy('name')
            ->get();

        $sections = Section::query()
            ->where('is_active', true)
            ->with('grade')
            ->orderBy('grade_id')
            ->orderBy('name')
            ->get();

        return view('admin.enrollments.create', compact('students', 'grades', 'sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'grade_id' => ['required', 'exists:grades,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'academic_year' => ['required', 'integer', 'min:2020', 'max:2100'],
            'enrollment_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['activo', 'inactivo', 'retirado', 'finalizado'])],
        ], [
            'student_id.required' => 'El alumno es obligatorio.',
            'student_id.exists' => 'El alumno seleccionado no existe.',
            'grade_id.required' => 'El grado es obligatorio.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'section_id.required' => 'La sección es obligatoria.',
            'section_id.exists' => 'La sección seleccionada no existe.',
            'academic_year.required' => 'El ciclo escolar es obligatorio.',
            'academic_year.integer' => 'El ciclo escolar debe ser un número.',
            'enrollment_date.required' => 'La fecha de inscripción es obligatoria.',
            'enrollment_date.date' => 'La fecha de inscripción no es válida.',
            'status.required' => 'El estado de inscripción es obligatorio.',
        ]);

        if (! Section::where('id', $validated['section_id'])->where('grade_id', $validated['grade_id'])->exists()) {
            return back()
                ->withErrors(['section_id' => 'La sección seleccionada no pertenece al grado indicado.'])
                ->withInput();
        }

        $exists = Enrollment::query()
            ->where('student_id', $validated['student_id'])
            ->where('academic_year', $validated['academic_year'])
            ->whereIn('status', ['activo', 'finalizado'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['student_id' => 'El alumno ya tiene una inscripción activa o finalizada para ese ciclo escolar.'])
                ->withInput();
        }

        Enrollment::create($validated);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Inscripción registrada correctamente.');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'grade', 'section']);

        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $grades = Grade::query()
            ->where('is_active', true)
            ->orderBy('level')
            ->orderBy('name')
            ->get();

        $sections = Section::query()
            ->where('is_active', true)
            ->with('grade')
            ->orderBy('grade_id')
            ->orderBy('name')
            ->get();

        return view('admin.enrollments.edit', compact('enrollment', 'students', 'grades', 'sections'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'grade_id' => ['required', 'exists:grades,id'],
            'section_id' => ['required', 'exists:sections,id'],
            'academic_year' => ['required', 'integer', 'min:2020', 'max:2100'],
            'enrollment_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['activo', 'inactivo', 'retirado', 'finalizado'])],
        ], [
            'student_id.required' => 'El alumno es obligatorio.',
            'student_id.exists' => 'El alumno seleccionado no existe.',
            'grade_id.required' => 'El grado es obligatorio.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'section_id.required' => 'La sección es obligatoria.',
            'section_id.exists' => 'La sección seleccionada no existe.',
            'academic_year.required' => 'El ciclo escolar es obligatorio.',
            'academic_year.integer' => 'El ciclo escolar debe ser un número.',
            'enrollment_date.required' => 'La fecha de inscripción es obligatoria.',
            'enrollment_date.date' => 'La fecha de inscripción no es válida.',
            'status.required' => 'El estado de inscripción es obligatorio.',
        ]);

        if (! Section::where('id', $validated['section_id'])->where('grade_id', $validated['grade_id'])->exists()) {
            return back()
                ->withErrors(['section_id' => 'La sección seleccionada no pertenece al grado indicado.'])
                ->withInput();
        }

        $exists = Enrollment::query()
            ->where('student_id', $validated['student_id'])
            ->where('academic_year', $validated['academic_year'])
            ->whereIn('status', ['activo', 'finalizado'])
            ->where('id', '!=', $enrollment->id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['student_id' => 'El alumno ya tiene otra inscripción activa o finalizada para ese ciclo escolar.'])
                ->withInput();
        }

        $enrollment->update($validated);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->update([
            'status' => 'inactivo',
        ]);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Inscripción inactivada correctamente.');
    }
}