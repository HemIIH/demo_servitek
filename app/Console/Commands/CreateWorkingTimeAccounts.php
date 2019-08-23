<?php

namespace App\Console\Commands;

use App\Models\Employee\Employee;
use Illuminate\Console\Command;

class CreateWorkingTimeAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employees:workingtime_accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create workingtime accounts for all employees.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $employees = Employee::whereIn('id', [52])->get();

        $employees->each(function($employee) {
//            $employee->workingTimeAccounts()->create([
//                'date'   => Carbon::now()->startOfMonth()->subMonth(),
//                'target' => $employee->contractual_working_hours ?: 0
//            ]);

            $workingHours = $employee->workingHours()->for(now())->get()->sortBy('valid_from');

            if ($workingHours->count() == 0) {
                $target = $employee->workingHours()->validAt(now()->startOfMonth())->first() ? $employee->workingHours()->validAt(now()->startOfMonth())->first()->hours : 0;
            } else {
                $target = $workingHours->map(function($workingHour) {
                    $validFrom = carbon($workingHour->valid_from) < now()->startOfMonth() ? now()->startOfMonth() : carbon($workingHour->valid_from);
                    $validTo = (carbon($workingHour->valid_to) > now()->endOfMonth() || $workingHour->valid_to == null) ? now()->endOfMonth()->addMinute() : carbon($workingHour->valid_to)->endOfDay()->addMinute();

                    return $validFrom->diffInDays($validTo) * $workingHour->hours;
                });

                $target = round($target->sum()/(now()->daysInMonth), 1);
            }

            $employee->workingTimeAccounts()->updateOrCreate([
                'date'   => now()->startOfMonth()
            ],[
                'date'   => now()->startOfMonth(),
                'target' => $target
            ]);

//            $employee->workingTimeAccounts()->create([
//                'date'   => now()->startOfMonth()->addMonth(),
//                'target' => $employee->contractual_working_hours ?: 0
//            ]);
        });
    }
}
