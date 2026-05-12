<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $sections = Section::query()
            ->with('grade')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('capacity', 'like', "%{$search}%")
                    ->orWhereHas('grade', function ($gradeQuery) use ($search) {
                        $gradeQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('level', 'like', "%{$search}%");
                    });
            })
            ->orderBy('grade_id')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.sections.index', compact('sections', 'search'));
    }

    public function create()
    {
        $grades = Grade::query()
            ->where('is_active', true)
            ->orderBy('level')
            ->orderBy('name')
            ->get();

        return view('admin.sections.create', compact('grades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'grade_id' => ['required', 'exists:grades,id'],
            'name' => ['required', 'string', 'max:20'],
            'capacity' => ['required', 'integer', 'min:1', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'grade_id.required' => 'El grado es obligatorio.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'name.required' => 'El nombre de la sección es obligatorio.',
            'capacity.required' => 'La capacidad es obligatoria.',
            'capacity.integer' => 'La capacidad debe ser un número entero.',
            'capacity.min' => 'La capacidad debe ser al menos 1.',
            'capacity.max' => 'La capacidad no puede ser mayor a 100.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Section::create($validated);

        return redirect()
            ->route('sections.index')
            ->with('success', 'Sección registrada correctamente.');
    }

    public function show(Section $section)
    {
        $section->load('grade');

        return view('admin.sections.show', compact('section'));
    }

    public function edit(Section $section)
    {
        $grades = Grade::query()
            ->where('is_active', true)
            ->orderBy('level')
            ->orderBy('name')
            ->get();

        return view('admin.sections.edit', compact('section', 'grades'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'grade_id' => ['required', 'exists:grades,id'],
            'name' => ['required', 'string', 'max:20'],
            'capacity' => ['required', 'integer', 'min:1', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'grade_id.required' => 'El grado es obligatorio.',
            'grade_id.exists' => 'El grado seleccionado no existe.',
            'name.required' => 'El nombre de la sección es obligatorio.',
            'capacity.required' => 'La capacidad es obligatoria.',
            'capacity.integer' => 'La capacidad debe ser un número entero.',
            'capacity.min' => 'La capacidad debe ser al menos 1.',
            'capacity.max' => 'La capacidad no puede ser mayor a 100.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $section->update($validated);

        return redirect()
            ->route('sections.index')
            ->with('success', 'Sección actualizada correctamente.');
    }

    public function destroy(Section $section)
    {
        $section->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('sections.index')
            ->with('success', 'Sección inactivada correctamente.');
    }
}