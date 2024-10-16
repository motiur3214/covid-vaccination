<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected SearchService $search_service;

    public function __construct(SearchService $search_service)
    {
        $this->search_service = $search_service;
    }

    public function index(Request $request)
    {
        $data['user'] = null;
        $data['searched'] = false;
        try {
            $query = $request->input('query');
            $request->validate([
                'query' => 'nullable|string',
            ]);

            if ($query) {
                $data['searched'] = true;
                $data['user'] = $this->search_service->searchUserByNid($query);
            }
        } catch (\Exception $exception) {
            \Log::info('Job executed for user: ' . json_encode($exception->getMessage()));
        }
        return view('search', compact('data'));
    }
}

