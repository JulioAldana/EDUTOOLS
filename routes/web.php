<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\GuardianController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\AttendanceRecordController;
use App\Http\Controllers\Admin\GradeRecordController;
use App\Http\Controllers\Admin\AcademicCalendarEventController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Portal\GuardianPortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)
    ->middleware(['auth', 'active', 'role:admin'])
    ->name('dashboard');

Route::resource('/students', StudentController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/teachers', TeacherController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/courses', CourseController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/grades', GradeController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/sections', SectionController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/guardians', GuardianController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/enrollments', EnrollmentController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/grade-records', GradeRecordController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/attendance-records', AttendanceRecordController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/academic-calendar-events', AcademicCalendarEventController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::resource('/users', UserController::class)
    ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'active', 'role:admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/portal')
    ->name('portal.')
    ->middleware(['auth', 'active', 'role:tutor'])
    ->group(function () {
        Route::get('/dashboard', [GuardianPortalController::class, 'dashboard'])
            ->name('dashboard');

        Route::get('/students/{student}', [GuardianPortalController::class, 'showStudent'])
            ->name('students.show');

        Route::get('/calendar', [GuardianPortalController::class, 'calendar'])
            ->name('calendar.index');
    });
    
require __DIR__.'/auth.php';