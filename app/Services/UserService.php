<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepository $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * Register a new user.
     *
     * @param array $data
     * @return User
     */
    public function registerUser(array $data): User
    {
        $user = $this->user_repository->create([
            'name' => $data['name'],
            'email' => strtolower($data['email']), // Ensure email is lowercase
            'nid' => $data['nid'],
            'vaccination_center_id' => $data['vaccination_center_id'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return $user;
    }

    public function getUserData($user_id): User
    {
        return $this->user_repository->getUserWithRelations($user_id);
    }
}
