<?php

namespace App\Http\Controllers;

use App\Enums\Frequency;
use App\Enums\Genres;
use App\Enums\Levels;
use App\Enums\Provinces;
use App\Enums\WeekDays;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class TabletopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Tabletop/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['string', 'required', 'max:100', 'unique:tabletops,name'],
            'genre' => [Rule::enum(Genres::class), 'required'],
            'province' => [Rule::enum(Provinces::class), 'required_if:presencial,true'],
            'level' => [Rule::enum(Levels::class), 'required'],
            'frequency' => [Rule::enum(Frequency::class)],
            'weekday' => [Rule::enum(WeekDays::class)],
            'horary' => ['string', 'regex:/^(([0-1]{0,1}[0-9])|(2[0-3])):[0-5]{0,1}[0-9]$/'],
            'city' => ['string', 'max:100', 'required_if:presencial,true'],
            'description' => ['string', 'max:1000', 'required'],
            'presencial' => ['boolean', 'required'],
        ]);

        $userWithTabletop = $request->user()->load('owns_tabletops');
        $userWithTabletop->owns_tabletops()->create($validated);

        return redirect('/mesas/minhas-mesas');
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
