<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $grades = Grade::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('level', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->withCount('sections')
            ->orderBy('level')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.grades.index', compact('grades', 'search'));
    }

    public function create()
    {
        return view('admin.grades.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'level' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'El nombre del grado es obligatorio.',
            'level.required' => 'El nivel académico es obligatorio.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Grade::create($validated);

        return redirect()
            ->route('grades.index')
            ->with('success', 'Grado registrado correctamente.');
    }

    public function show(Grade $grade)
    {
        $grade->load('sections');

        return view('admin.grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        return view('admin.grades.edit', compact('grade'));
    }

    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'level' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'El nombre del grado es obligatorio.',
            'level.required' => 'El nivel académico es obligatorio.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $grade->update($validated);

        return redirect()
            ->route('grades.index')
            ->with('success', 'Grado actualizado correctamente.');
    }

    public function destroy(Grade $grade)
    {
        $grade->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('grades.index')
            ->with('success', 'Grado inactivado correctamente.');
    }
}