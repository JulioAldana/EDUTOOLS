<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $students = Student::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('student_code', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.students.index', compact('students', 'search'));
    }

    public function create()
    {
    return view('admin.students.create');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'student_code' => ['required', 'string', 'max:20', 'unique:students,student_code'],
        'first_name' => ['required', 'string', 'max:100'],
        'last_name' => ['required', 'string', 'max:100'],
        'birth_date' => ['nullable', 'date'],
        'gender' => ['nullable', 'string', 'max:20'],
        'phone' => ['nullable', 'string', 'max:25'],
        'address' => ['nullable', 'string', 'max:255'],
        'is_active' => ['nullable', 'boolean'],
    ], [
        'student_code.required' => 'El código del alumno es obligatorio.',
        'student_code.unique' => 'El código del alumno ya existe.',
        'first_name.required' => 'El nombre del alumno es obligatorio.',
        'last_name.required' => 'El apellido del alumno es obligatorio.',
    ]);

    $validated['is_active'] = $request->boolean('is_active');

    Student::create($validated);

    return redirect()
        ->route('students.index')
        ->with('success', 'Alumno registrado correctamente.');
    }

    public function show(Student $student)
    {
    return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
    return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
    $validated = $request->validate([
        'student_code' => ['required', 'string', 'max:20', 'unique:students,student_code,' . $student->id],
        'first_name' => ['required', 'string', 'max:100'],
        'last_name' => ['required', 'string', 'max:100'],
        'birth_date' => ['nullable', 'date'],
        'gender' => ['nullable', 'string', 'max:20'],
        'phone' => ['nullable', 'string', 'max:25'],
        'address' => ['nullable', 'string', 'max:255'],
        'is_active' => ['nullable', 'boolean'],
    ], [
        'student_code.required' => 'El código del alumno es obligatorio.',
        'student_code.unique' => 'El código del alumno ya está asignado a otro estudiante.',
        'first_name.required' => 'El nombre del alumno es obligatorio.',
        'last_name.required' => 'El apellido del alumno es obligatorio.',
    ]);

    $validated['is_active'] = $request->boolean('is_active');

    $student->update($validated);

    return redirect()
        ->route('students.index')
        ->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy(Student $student)
    {
    $student->update([
        'is_active' => false,
    ]);

    return redirect()
        ->route('students.index')
        ->with('success', 'Alumno inactivado correctamente.');
    }
}