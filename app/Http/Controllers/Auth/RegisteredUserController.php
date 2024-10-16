<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    protected UserService $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        try {
            $this->user_service->registerUser($request->validated());
        } catch (\Exception $exception) {
            \Log::info('Job executed for user: ' . json_encode($exception->getMessage()));
        }
        return redirect(route('dashboard', absolute: false));
    }
}

