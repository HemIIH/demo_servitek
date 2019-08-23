<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $notes = [
            1 => 'Hat sich für das Wochenende krank gemeldet.',
            2 => 'Interessiert sich für eine Teilzeit-Stelle.',
            3 => 'Ist die erste Hälfte des Jahres im Ausland.',
            4 => 'Benötigt eine neue Weste sowie ein Kellnermesser.',
            5 => 'Will verstärkt in Köln eingesetzt werden.',
            6 => 'Wurde zum nächsten Monat gekündigt.'
        ];

        factory(App\Models\Employee\Employee::class, 20)->create()->each(function($employee) {
            $employee->wages()->save(factory(\App\Models\Employee\Wage::class)->make());
            $employee->workingHours()->save(factory(\App\Models\Employee\WorkingHours::class)->make());

            for ($i = 0; $i <= 2; $i++) {
                $employee->roles()->syncWithoutDetaching([random_int(1, 4)]);
            }
        });

        for ($i = 1; $i <= 6; $i++) {
            \App\Models\Employee\Employee::find($i)->notes()->save(factory(App\Models\Note::class)->make(['information' => $notes[$i]]));
        }

    }
}
