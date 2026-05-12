<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $teachers = Teacher::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('teacher_code', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('dpi', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('specialty', 'like', "%{$search}%");
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.teachers.index', compact('teachers', 'search'));
    }

    public function create()
    {
    return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'teacher_code' => ['required', 'string', 'max:20', 'unique:teachers,teacher_code'],
        'first_name' => ['required', 'string', 'max:100'],
        'last_name' => ['required', 'string', 'max:100'],
        'dpi' => ['nullable', 'string', 'max:20', 'unique:teachers,dpi'],
        'phone' => ['nullable', 'string', 'max:25'],
        'email' => ['nullable', 'email', 'max:150', 'unique:teachers,email'],
        'specialty' => ['nullable', 'string', 'max:100'],
        'hire_date' => ['nullable', 'date'],
        'is_active' => ['nullable', 'boolean'],
    ], [
        'teacher_code.required' => 'El código del docente es obligatorio.',
        'teacher_code.unique' => 'El código del docente ya existe.',
        'first_name.required' => 'El nombre del docente es obligatorio.',
        'last_name.required' => 'El apellido del docente es obligatorio.',
        'dpi.unique' => 'El DPI ya está registrado en otro docente.',
        'email.email' => 'Debe ingresar un correo válido.',
        'email.unique' => 'El correo ya está registrado en otro docente.',
    ]);

    $validated['is_active'] = $request->boolean('is_active');

    Teacher::create($validated);

    return redirect()
        ->route('teachers.index')
        ->with('success', 'Docente registrado correctamente.');
    }

    public function show(Teacher $teacher)
    {
    return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
    return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
    $validated = $request->validate([
        'teacher_code' => ['required', 'string', 'max:20', 'unique:teachers,teacher_code,' . $teacher->id],
        'first_name' => ['required', 'string', 'max:100'],
        'last_name' => ['required', 'string', 'max:100'],
        'dpi' => ['nullable', 'string', 'max:20', 'unique:teachers,dpi,' . $teacher->id],
        'phone' => ['nullable', 'string', 'max:25'],
        'email' => ['nullable', 'email', 'max:150', 'unique:teachers,email,' . $teacher->id],
        'specialty' => ['nullable', 'string', 'max:100'],
        'hire_date' => ['nullable', 'date'],
        'is_active' => ['nullable', 'boolean'],
    ], [
        'teacher_code.required' => 'El código del docente es obligatorio.',
        'teacher_code.unique' => 'El código del docente ya está asignado a otro docente.',
        'first_name.required' => 'El nombre del docente es obligatorio.',
        'last_name.required' => 'El apellido del docente es obligatorio.',
        'dpi.unique' => 'El DPI ya está registrado en otro docente.',
        'email.email' => 'Debe ingresar un correo válido.',
        'email.unique' => 'El correo ya está registrado en otro docente.',
    ]);

    $validated['is_active'] = $request->boolean('is_active');

    $teacher->update($validated);

    return redirect()
        ->route('teachers.index')
        ->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Teacher $teacher)
    {
    $teacher->update([
        'is_active' => false,
    ]);

    return redirect()
        ->route('teachers.index')
        ->with('success', 'Docente inactivado correctamente.');
    }
}