<?php

use Illuminate\Support\Facades\Schedule;

use App\Jobs\SendVaccinationReminderJob;
use App\Models\VaccineSchedule;
use Carbon\Carbon;

Schedule::call(function () {

    $tomorrow = Carbon::now()->addDay();
    $users = VaccineSchedule::with('user')
        ->whereDate('schedule_date', $tomorrow)
        ->get()
        ->pluck('user');

    foreach ($users as $user) {
        dispatch(new SendVaccinationReminderJob($user, $tomorrow));
        \Log::info('Job executed for user: ' . json_encode($users));
    }

})->dailyAt('01:26');
//})->everyMinute();



