<?php

namespace App\Http\Controllers;

use App\Models\ModelChirp;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ModelChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        return view('chirp.index', [
            'chirpList' => ModelChirp::with('user')->latest()->get(),
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]); 
        $request->user()->useHasChirps()->create($validated); 
        return redirect(route('routeChirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelChirp $modelChirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelChirp $routeChirp): View
    {
        $this->authorize('update', $routeChirp);

        return view('chirp.edit', [
            'chirpEdit' => $routeChirp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelChirp $routeChirp): RedirectResponse
    {
        $this->authorize('update', $routeChirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $routeChirp->update($validated);
        return redirect(route('routeChirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelChirp $modelChirp)
    {
        //
    }
}
