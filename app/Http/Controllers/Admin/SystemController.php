<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SystemResource;
use App\Models\System;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $genreFilter = $request->input('genre-filter');

        if(!$search) {
            $systems = System::paginate(12);
        } else {
            $systems = System::search($search)
            ->when($genreFilter, function($query, $genreFilter) {
                $query->where('genre', $genreFilter);
            })
            ->paginate(12)
            ->appends(['search' => $search, 'filter' => $genreFilter]);
        }

        return Inertia::render('Admin/System/Index', [
            'systems' => SystemResource::collection($systems),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
