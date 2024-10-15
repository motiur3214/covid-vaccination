<?php
namespace App\Services;

use App\Repositories\UserRepository;

class SearchService
{
    protected UserRepository $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function searchUserByNid(string $nid)
    {
        return $this->user_repository->findUserByNidWithRelations($nid);
    }
}
