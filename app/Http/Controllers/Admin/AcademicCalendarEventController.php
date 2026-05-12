<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendarEvent;
use Illuminate\Http\Request;

class AcademicCalendarEventController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search'));

        $events = AcademicCalendarEvent::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('event_type', 'like', "%{$search}%")
                    ->orWhere('event_date', 'like', "%{$search}%");
            })
            ->orderByDesc('event_date')
            ->orderBy('start_time')
            ->paginate(10)
            ->withQueryString();

        return view('admin.academic-calendar-events.index', compact('events', 'search'));
    }

    public function create()
    {
        return view('admin.academic-calendar-events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i', 'after_or_equal:start_time'],
            'event_type' => ['required', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'El título del evento es obligatorio.',
            'event_date.required' => 'La fecha del evento es obligatoria.',
            'event_date.date' => 'La fecha del evento no es válida.',
            'start_time.date_format' => 'La hora de inicio no tiene un formato válido.',
            'end_time.date_format' => 'La hora de finalización no tiene un formato válido.',
            'end_time.after_or_equal' => 'La hora de finalización no puede ser menor que la hora de inicio.',
            'event_type.required' => 'El tipo de evento es obligatorio.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        AcademicCalendarEvent::create($validated);

        return redirect()
            ->route('academic-calendar-events.index')
            ->with('success', 'Evento académico registrado correctamente.');
    }

    public function show(AcademicCalendarEvent $academicCalendarEvent)
    {
        return view('admin.academic-calendar-events.show', [
            'event' => $academicCalendarEvent,
        ]);
    }

    public function edit(AcademicCalendarEvent $academicCalendarEvent)
    {
        return view('admin.academic-calendar-events.edit', [
            'event' => $academicCalendarEvent,
        ]);
    }

    public function update(Request $request, AcademicCalendarEvent $academicCalendarEvent)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i', 'after_or_equal:start_time'],
            'event_type' => ['required', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'El título del evento es obligatorio.',
            'event_date.required' => 'La fecha del evento es obligatoria.',
            'event_date.date' => 'La fecha del evento no es válida.',
            'start_time.date_format' => 'La hora de inicio no tiene un formato válido.',
            'end_time.date_format' => 'La hora de finalización no tiene un formato válido.',
            'end_time.after_or_equal' => 'La hora de finalización no puede ser menor que la hora de inicio.',
            'event_type.required' => 'El tipo de evento es obligatorio.',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $academicCalendarEvent->update($validated);

        return redirect()
            ->route('academic-calendar-events.index')
            ->with('success', 'Evento académico actualizado correctamente.');
    }

    public function destroy(AcademicCalendarEvent $academicCalendarEvent)
    {
        $academicCalendarEvent->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('academic-calendar-events.index')
            ->with('success', 'Evento académico inactivado correctamente.');
    }
}