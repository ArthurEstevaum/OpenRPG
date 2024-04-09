<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Genres;
use App\Http\Controllers\Controller;
use App\Http\Resources\SystemResource;
use App\Models\System;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if(!$search) {
            $systems = System::paginate(12);
        } else {
            $systems = System::search($search)
            ->paginate(12)
            ->appends(['search' => $search, 'query' => null]);
        }

        return Inertia::render('Admin/System/Index', [
            'systems' => SystemResource::collection($systems),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : InertiaResponse
    {
        return Inertia::render('Admin/System/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => [Rule::enum(Genres::class), 'required'],
        ]);

        $system = System::create([
            'name' => $validated['name'],
            'genre' => $validated['genre'],
        ]);

        return redirect(route('admin.system.index'))->with('success', 'Sistema criado com sucesso');
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
