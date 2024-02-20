<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeagueRequest;
use App\Http\Requests\UpdateLeagueRequest;
use App\Models\League;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',League::class);

        return view('league.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',League::class);

        return view('league.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeagueRequest $request)
    {
        $this->authorize('create',League::class);
        
        $league = League::create($request->validated());

        self::success($league->name.' '.__('has been successfully created'));

        return redirect(route('league.show',$league));
    }

    /**
     * Display the specified resource.
     */
    public function show(League $league)
    {
        $this->authorize('view',$league);

        return view('league.show', compact('league'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(League $league)
    {
        $this->authorize('update',$league);

        return view('league.edit', compact('league'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeagueRequest $request, League $league)
    {
        $this->authorize('update',$league);
        
        $league->update($request->validated());

        self::success($league->name.' '.__('has been successfully updated'));

        return redirect(route('league.show',$league));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(League $league)
    {
        $this->authorize('create',League::class);
        
        $league->delete();

        self::success($league->name.' '.__('has been successfully deleted'));

        return redirect(route('league.index'));
    }
}
