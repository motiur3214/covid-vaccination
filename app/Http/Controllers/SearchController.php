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
        $query = $request->input('query');
        $data['user'] = null;
        $data['searched'] = false;
        $request->validate([
            'query' => 'nullable|string',
        ]);

        if ($query) {
            $data['searched'] = true;
            $data['user'] = $this->search_service->searchUserByNid($query);
        }

        return view('search', compact('data'));
    }
}

