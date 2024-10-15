<?php

namespace App\Repositories;

use App\Models\VaccinationCenter;
use Illuminate\Database\Eloquent\Collection;

class VaccinationCenterRepository
{
    public function vaccine_centers(int $per_page, ?string $search_term = null)
    {
        if (!$search_term) {
            return VaccinationCenter::paginate($per_page);
        }

        return VaccinationCenter::where('name', 'like', "%{$search_term}%")
            ->paginate($per_page);
    }
}
