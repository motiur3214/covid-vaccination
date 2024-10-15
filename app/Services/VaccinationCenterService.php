<?php

namespace App\Services;

use App\Repositories\VaccinationCenterRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VaccinationCenterService
{
    protected VaccinationCenterRepository $repository;

    public function __construct(VaccinationCenterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getVaccinationCenters(int $perPage, ?string $searchTerm = null): LengthAwarePaginator
    {
        return $this->repository->vaccine_centers($perPage, $searchTerm);
    }
}
