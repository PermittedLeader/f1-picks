<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLeagueRequest;
use App\Http\Requests\UpdateLeagueRequest;

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

        $league->admins()->attach(request()->user());

        $league->regeneratePassword();

        self::success($league->name.' '.__('has been successfully created'));

        return redirect(route('league.show',$league));
    }

    /**
     * Display the specified resource.
     */
    public function show(League $league)
    {
        $this->authorize('view',$league);

        if($league->seasons->count() < 1){
            self::warning('Leagues need at least a single season of events');
        }
        if($league->members()->where('id',request()->user()->id)->exists()){
            return view('league.show', compact('league'));
        } else {
            return view('league.password', compact('league'));
        }
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

    public function join(League $league)
    {
        if(!$league->public)
        {
            abort(403);
        }

        auth()->user()->leagues()->attach($league);

        self::success(__('You have joined :leagueName',['leagueName'=>$league->name]),__('Welcome'));

        return redirect(route('league.show',$league));
    }

    public function code(Request $request)
    {
        $league = League::where('slug', $request->input('slug'))->first();

        return redirect(route('league.show',$league));
    }

    public function joinWithPassword(Request $request, League $league)
    {
        if($league->password == $request->input('password')){
            $league->members()->attach(request()->user());

            self::success(__('crud.leagues.joined'));

            return redirect(route('league.show', $league));
        } else {
            self::warning(__('crud.leagues.incorrect_password'));

            return redirect()->back();
        }
    }
}
