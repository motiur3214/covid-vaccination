<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected UserService $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function index()
    {
        try {
            $user_id = Auth::user()->id;

            $data['user'] = $this->user_service->getUserData($user_id);
            return view('dashboard', compact('data'));
        } catch (\Exception $exception) {
            \Log::info('Job executed for user: ' . json_encode($exception->getMessage()));
        }
    }
}
