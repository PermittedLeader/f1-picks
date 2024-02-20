<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeasonRequest;
use App\Http\Requests\UpdateSeasonRequest;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Season::class);

        return view('season.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Season::class);

        return view('season.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeasonRequest $request)
    {
        $this->authorize('create',Season::class);
        
        $season = Season::create($request->validated());

        self::success($season->name.' '.__('has been successfully created'));

        return redirect(route('season.show',$season));
    }

    /**
     * Display the specified resource.
     */
    public function show(Season $season)
    {
        $this->authorize('view',$season);

        return view('season.show', compact('season'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Season $season)
    {
        $this->authorize('update',$season);

        return view('season.edit', compact('season'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeasonRequest $request, Season $season)
    {
        $this->authorize('update',$season);
        
        $season->update($request->validated());

        self::success($season->name.' '.__('has been successfully updated'));

        return redirect(route('season.show',$season));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Season $season)
    {
        $this->authorize('create',Season::class);
        
        $season->delete();

        self::success($season->name.' '.__('has been successfully deleted'));

        return redirect(route('season.index'));
    }
}
