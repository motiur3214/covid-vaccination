<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function updateUserProfile($user, array $data)
    {
        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        return $this->user_repository->update($user, $data);
    }

    public function deleteUserAccount($user)
    {
        Auth::logout();
        $this->user_repository->delete($user);
    }
}
