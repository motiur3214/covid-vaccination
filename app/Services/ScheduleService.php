<?php


namespace App\Services;

use App\Repositories\VaccineScheduleRepository;
use Carbon\Carbon;
use Exception;

class ScheduleService
{
    protected VaccineScheduleRepository $repository;

    public function __construct(VaccineScheduleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function scheduleVaccine(int $userId, int $vaccination_center_id, ?Carbon $schedule_date, int $daily_limit): Carbon
    {
        if ($schedule_date) {
            throw new Exception('You are already scheduled for a vaccination.');
        }

        if ($this->repository->existsByUserId($userId)) {
            throw new Exception('You are already scheduled for a vaccination.');
        }

        $scheduled_count_tomorrow = $this->repository->countScheduledTomorrow($vaccination_center_id);
        $schedule_date = $this->getAvailableWeekday($scheduled_count_tomorrow, $daily_limit, $vaccination_center_id);

        $this->repository->create([
            'user_id' => $userId,
            'vaccination_center_id' => $vaccination_center_id,
            'schedule_date' => $schedule_date,
        ]);

        return $schedule_date;
    }

    private function getAvailableWeekday($current_count, $daily_limit, $vaccination_center_id): Carbon
    {
        $date = Carbon::tomorrow();
        $saturday = $date->isSaturday();
        $sunday = $date->isSunday();

        if ($current_count < $daily_limit && (!$saturday && !$sunday)) {
            return $date;
        }

        do {
            $date->addDay();

            if ($saturday || $sunday) {
                continue;
            }

            $current_count = $this->repository->countScheduledForDate($vaccination_center_id, $date);

        } while ($current_count >= $daily_limit);

        return $date;
    }
}
