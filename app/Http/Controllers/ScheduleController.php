<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


class ScheduleController extends controller
{
    protected ScheduleService $schedule_service;

    public function __construct(ScheduleService $schedule_Service)
    {
        $this->schedule_service = $schedule_Service;
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'daily_limit' => 'required|int',
                'schedule_date' => 'nullable|date'
            ], [
                'daily_limit' => 'Something went wrong',
            ]);

            $vaccination_center_Id = auth()->user()->vaccination_center_id;
            $this->schedule_service->scheduleVaccine(auth()->user()->id, $vaccination_center_Id, $request->schedule_date, $request->daily_limit);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['registration' => $e->getMessage()]);
        }

        return redirect('dashboard');
    }
}
