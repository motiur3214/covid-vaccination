<?php


namespace App\Repositories;

use App\Models\VaccineSchedule;
use Carbon\Carbon;

class VaccineScheduleRepository
{
    public function existsByUserId(int $user_id): bool
    {
        return VaccineSchedule::where('user_id', $user_id)->exists();
    }

    public function countScheduledTomorrow(int $vaccination_center_id): int
    {
        return VaccineSchedule::where('vaccination_center_id', $vaccination_center_id)
            ->whereDate('schedule_date', Carbon::tomorrow())
            ->count();
    }

    public function create(array $data): VaccineSchedule
    {
        return VaccineSchedule::create($data);
    }

    public function countScheduledForDate(int $vaccination_center_id, Carbon $date): int
    {
        return VaccineSchedule::where('vaccination_center_id', $vaccination_center_id)
            ->whereDate('schedule_date', $date)
            ->count();
    }
}
