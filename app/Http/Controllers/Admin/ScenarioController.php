<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScenarioResource;
use App\Models\Scenario;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScenarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if(!$search) {
            $scenarios = Scenario::paginate(12);
        } else {
            $scenarios = Scenario::search($search)
            ->paginate(12)
            ->appends(['search' => $search, 'query' => null]);
        }

        return Inertia::render('Admin/Scenario/Index', [
            'scenarios' => ScenarioResource::collection($scenarios),
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
