<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $courses = Course::query()
            ->with(['grade', 'teacher'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('grade', function ($gradeQuery) use ($search) {
                        $gradeQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('teacher', function ($teacherQuery) use ($search) {
                        $teacherQuery->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.courses.index', compact('courses', 'search'));
    }

    public function create()
    {
        $grades = Grade::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('admin.courses.create', compact('grades', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'grade_id' => ['required', 'exists:grades,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'code' => ['required', 'string', 'max:20', 'unique:courses,code'],
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'weekly_hours' => ['required', 'integer', 'min:1', 'max:40'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'grade_id.required' => 'El grado es obligatorio.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
            'code.required' => 'El código del curso es obligatorio.',
            'code.unique' => 'El código del curso ya existe.',
            'name.required' => 'El nombre del curso es obligatorio.',
            'weekly_hours.required' => 'Las horas semanales son obligatorias.',
            'weekly_hours.integer' => 'Las horas semanales deben ser un número entero.',
            'weekly_hours.min' => 'Las horas semanales deben ser al menos 1.',
            'weekly_hours.max' => 'Las horas semanales no pueden ser mayores a 40.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso registrado correctamente.');
    }

    public function show(Course $course)
    {
        $course->load(['grade', 'teacher']);

        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $grades = Grade::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $teachers = Teacher::query()
            ->where('is_active', true)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('admin.courses.edit', compact('course', 'grades', 'teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'grade_id' => ['required', 'exists:grades,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
            'code' => ['required', 'string', 'max:20', 'unique:courses,code,' . $course->id],
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'weekly_hours' => ['required', 'integer', 'min:1', 'max:40'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'grade_id.required' => 'El grado es obligatorio.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'teacher_id.exists' => 'El docente seleccionado no existe.',
            'code.required' => 'El código del curso es obligatorio.',
            'code.unique' => 'El código del curso ya está asignado a otro curso.',
            'name.required' => 'El nombre del curso es obligatorio.',
            'weekly_hours.required' => 'Las horas semanales son obligatorias.',
            'weekly_hours.integer' => 'Las horas semanales deben ser un número entero.',
            'weekly_hours.min' => 'Las horas semanales deben ser al menos 1.',
            'weekly_hours.max' => 'Las horas semanales no pueden ser mayores a 40.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy(Course $course)
    {
        $course->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Curso inactivado correctamente.');
    }
}