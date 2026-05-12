<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $guardians = Guardian::query()
            ->withCount('students')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('dpi', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('relationship', 'like', "%{$search}%")
                    ->orWhereHas('students', function ($studentQuery) use ($search) {
                        $studentQuery->where('student_code', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.guardians.index', compact('guardians', 'search'));
    }

    public function create()
    {
    $students = Student::query()
        ->where('is_active', true)
        ->orderBy('last_name')
        ->orderBy('first_name')
        ->get();

    $users = User::query()
        ->where('role', 'tutor')
        ->where('is_active', true)
        ->whereDoesntHave('guardian')
        ->orderBy('name')
        ->get();

    return view('admin.guardians.create', compact('students', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['nullable', 'exists:users,id', 'unique:guardians,user_id'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'dpi' => ['nullable', 'string', 'max:20', 'unique:guardians,dpi'],
            'phone' => ['required', 'string', 'max:25'],
            'address' => ['nullable', 'string', 'max:255'],
            'relationship' => ['required', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'student_ids' => ['nullable', 'array'],
            'student_ids.*' => ['exists:students,id'],
            'primary_student_id' => ['nullable', 'exists:students,id'],
        ], [
            'first_name.required' => 'El nombre del tutor es obligatorio.',
            'last_name.required' => 'El apellido del tutor es obligatorio.',
            'dpi.unique' => 'El DPI ya está registrado en otro tutor.',
            'phone.required' => 'El teléfono del tutor es obligatorio.',
            'relationship.required' => 'El parentesco es obligatorio.',
            'student_ids.*.exists' => 'Uno de los alumnos seleccionados no existe.',
            'primary_student_id.exists' => 'El alumno principal seleccionado no existe.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'user_id.unique' => 'El usuario seleccionado ya está vinculado a otro tutor.',
        ]);

        $studentIds = $validated['student_ids'] ?? [];
        $primaryStudentId = $validated['primary_student_id'] ?? null;

        unset($validated['student_ids'], $validated['primary_student_id']);

        $validated['is_active'] = $request->boolean('is_active');

        $guardian = Guardian::create($validated);

        $this->syncStudents($guardian, $studentIds, $primaryStudentId);

        return redirect()
            ->route('guardians.index')
            ->with('success', 'Tutor registrado correctamente.');
    }

    public function show(Guardian $guardian)
    {
        $guardian->load('students');

        return view('admin.guardians.show', compact('guardian'));
    }

    public function edit(Guardian $guardian)
    {
    $guardian->load('students');

    $students = Student::query()
        ->orderBy('last_name')
        ->orderBy('first_name')
        ->get();

    $users = User::query()
        ->where('role', 'tutor')
        ->where('is_active', true)
        ->where(function ($query) use ($guardian) {
            $query->whereDoesntHave('guardian')
                ->orWhere('id', $guardian->user_id);
        })
        ->orderBy('name')
        ->get();

    return view('admin.guardians.edit', compact('guardian', 'students', 'users'));
    }

    public function update(Request $request, Guardian $guardian)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'dpi' => ['nullable', 'string', 'max:20', 'unique:guardians,dpi,' . $guardian->id],
            'phone' => ['required', 'string', 'max:25'],
            'address' => ['nullable', 'string', 'max:255'],
            'relationship' => ['required', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
            'student_ids' => ['nullable', 'array'],
            'student_ids.*' => ['exists:students,id'],
            'primary_student_id' => ['nullable', 'exists:students,id'],
        ], [
            'first_name.required' => 'El nombre del tutor es obligatorio.',
            'last_name.required' => 'El apellido del tutor es obligatorio.',
            'dpi.unique' => 'El DPI ya está registrado en otro tutor.',
            'phone.required' => 'El teléfono del tutor es obligatorio.',
            'relationship.required' => 'El parentesco es obligatorio.',
            'student_ids.*.exists' => 'Uno de los alumnos seleccionados no existe.',
            'primary_student_id.exists' => 'El alumno principal seleccionado no existe.',
        ]);

        $studentIds = $validated['student_ids'] ?? [];
        $primaryStudentId = $validated['primary_student_id'] ?? null;

        unset($validated['student_ids'], $validated['primary_student_id']);

        $validated['is_active'] = $request->boolean('is_active');

        $guardian->update($validated);

        $this->syncStudents($guardian, $studentIds, $primaryStudentId);

        return redirect()
            ->route('guardians.index')
            ->with('success', 'Tutor actualizado correctamente.');
    }

    public function destroy(Guardian $guardian)
    {
        $guardian->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('guardians.index')
            ->with('success', 'Tutor inactivado correctamente.');
    }

    private function syncStudents(Guardian $guardian, array $studentIds, ?int $primaryStudentId): void
    {
        $syncData = [];

        foreach ($studentIds as $studentId) {
            $syncData[$studentId] = [
                'is_primary' => (int) $studentId === (int) $primaryStudentId,
            ];
        }

        $guardian->students()->sync($syncData);
    }
}