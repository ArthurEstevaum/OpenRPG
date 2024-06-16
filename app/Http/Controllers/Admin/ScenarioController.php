<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScenarioResource;
use App\Models\Scenario;
use App\Models\System;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ScenarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): InertiaResponse
    {
        $search = $request->input('search');

        if (! $search) {
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
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Scenario/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'system' => 'string|required|exists:systems,name',
        ]);

        $system = System::where('name', $validated['system'])->firstOrFail();

        $system->scenarios()->create([
            'name' => $validated['name'],
        ]);

        return redirect(route('admin.scenario.index'))->with('success', 'Cenário criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Scenario $scenario): InertiaResponse
    {
        $scenario = $scenario->load('system');

        return Inertia::render('Admin/Scenario/Show', [
            'scenario' => $scenario,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scenario $scenario): InertiaResponse
    {
        $scenario->load('system');

        return Inertia::render('Admin/Scenario/Edit', ['scenario' => $scenario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scenario $scenario): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'system' => 'string|required|exists:systems,name',
        ]);

        $system = System::where('name', '=', $validated['system'])->firstOrFail();

        Scenario::find($scenario->id)->update([
            'name' => $validated['name'],
        ]);
        $scenario->system()->associate($system);
        $scenario->save();

        return redirect(route('admin.scenario.show', ['scenario' => $scenario->id]));
    }

    /**
     * Show the page to confirm the deletion of the resource.
     */
    public function delete(Scenario $scenario): InertiaResponse
    {
        return Inertia::render('Admin/Scenario/Delete', ['scenario' => $scenario]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scenario $scenario): RedirectResponse
    {
        Scenario::destroy($scenario->id);

        return redirect(route('admin.scenario.index'))->with('success', 'Cenário de jogo excluído com sucesso');
    }
}
