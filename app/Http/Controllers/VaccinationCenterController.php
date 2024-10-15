<?php

namespace App\Http\Controllers;

use App\Services\VaccinationCenterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VaccinationCenterController extends Controller
{
    protected VaccinationCenterService $vaccination_center_service;

    public function __construct(VaccinationCenterService $vaccination_center_service)
    {
        $this->vaccination_center_service = $vaccination_center_service;
    }
    public function index(Request $request): JsonResponse
    {
        $search_term = $request->input('query');
        $perPage = 10;

        $vaccination_centers = $this->vaccination_center_service->getVaccinationCenters($perPage, $search_term);

        return response()->json($vaccination_centers);

    }

}
