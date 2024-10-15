<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): bool
    {
        return $user->save($data);
    }

    public function delete(User $user): ?bool
    {
        return $user->delete();
    }

    public function getUserWithRelations($user_id)
    {
        return User::with(['schedule' => function ($query) {
            $query->select('id', 'user_id', 'schedule_date as date');
        }, 'vaccine_center' => function ($query) {
            $query->select('id', 'name', 'daily_limit');
        }])->find($user_id);
    }

    public function findUserByNidWithRelations(string $nid)
    {
        $cacheKey = 'user_search_' . $nid;

        return cache()->remember($cacheKey, 5, function () use ($nid) {
            return User::select(['id', 'nid', 'name', 'email', 'vaccination_center_id'])
                ->with([
                    'schedule' => function ($query) {
                        $query->select('id', 'user_id', 'schedule_date as date');
                    },
                    'vaccine_center' => function ($query) {
                        $query->select('id', 'name');
                    }
                ])
                ->where('nid', $nid)
                ->first();
        });
    }

}
