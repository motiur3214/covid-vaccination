<?php

namespace App\Http\Controllers;

use App\Models\VaccinationCenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VaccinationCenterController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $searchTerm = $request->input('query');
        $perPage = 10;

        if (!$searchTerm) {
            $vaccinationCenters = VaccinationCenter::paginate($perPage);
            return response()->json($vaccinationCenters);
        }

        $vaccinationCenters = VaccinationCenter::where('name', 'like', "%{$searchTerm}%")
            ->paginate($perPage);

        return response()->json($vaccinationCenters);
    }

}
