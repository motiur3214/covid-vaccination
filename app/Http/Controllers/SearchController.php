<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $results = collect([
            (object) ['name' => 'John Doe', 'nid' => '123456', 'status' => 'Vaccinated'],
            (object) ['name' => 'Jane Smith', 'nid' => '654321', 'status' => 'Pending'],
        ])->filter(function($result) use ($query) {
            return str_contains(strtolower($result->name), strtolower($query)) ||
                str_contains($result->nid, $query);
        });

        return view('search', ['results' => $results]);
    }
}

