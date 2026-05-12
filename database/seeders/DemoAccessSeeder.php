<?php

namespace Database\Seeders;

use App\Models\Guardian;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoAccessSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@edutools.test'],
            [
                'name' => 'Administrador EDUTOOLS',
                'password' => Hash::make('EdutoolsF_2026'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        $portalUser = User::updateOrCreate(
            ['email' => 'portal.familiar@edutools.test'],
            [
                'name' => 'Encargado Portal Familiar',
                'password' => Hash::make('EdutoolsF_2026'),
                'role' => 'tutor',
                'is_active' => true,
            ]
        );

        $guardian = Guardian::where('user_id', $portalUser->id)->first();

        if (! $guardian) {
            $guardian = Guardian::whereNull('user_id')
                ->where('is_active', true)
                ->first();
        }

        if (! $guardian) {
            $guardian = Guardian::create([
                'user_id' => $portalUser->id,
                'first_name' => 'Encargado',
                'last_name' => 'Familiar',
                'dpi' => '2999999999999',
                'phone' => '5555-9999',
                'address' => 'Morales, Izabal',
                'relationship' => 'Padre',
                'is_active' => true,
            ]);
        }

        $guardian->update([
            'user_id' => $portalUser->id,
        ]);

        if ($guardian->students()->count() === 0) {
            $student = Student::where('is_active', true)->first();

            if ($student) {
                $guardian->students()->syncWithoutDetaching([
                    $student->id => ['is_primary' => true],
                ]);
            }
        }
    }
}