<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected ProfileService $profile_service;

    public function __construct(ProfileService $profile_service)
    {
        $this->profile_service = $profile_service;
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $this->profile_service->updateUserProfile($request->user(), $request->validated());
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $exception) {
            \Log::info('Job executed for user: ' . json_encode($exception->getMessage()));

        }
        return Redirect::route('profile.edit')->with('status', 'Something went wrong');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $this->profile_service->deleteUserAccount($request->user());
        } catch (\Exception $exception) {
            \Log::info('Job executed for user: ' . json_encode($exception->getMessage()));
        }

        return Redirect::to('/');
    }
}

