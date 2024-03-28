<?php

namespace App\Http\Controllers;

use App\Models\Pick;
use App\Models\Event;
use App\Models\League;
use App\Http\Requests\StorePickRequest;
use App\Http\Requests\UpdatePickRequest;
use App\Models\Season;
use Illuminate\Support\Facades\Request;

class PickController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Pick::class);

        return view('pick.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(League $league, Season $season, Event $event)
    {
        $this->authorize('create',[Pick::class,$event,$league,$season]);

        $data = compact('event','league','season');

        return view('pick.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePickRequest $request,League $league, Season $season, Event $event)
    {
        $pick = Pick::create($request->validated());

        self::success(__('Your picks are in!'),__('Good Luck!'));

        return redirect(route('league.show',$league));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pick $pick)
    {
        $this->authorize('view',$pick);

        return view('pick.show', compact('pick'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(League $league, Season $season, Event $event,Pick $pick)
    {
        $this->authorize('update',[$pick, $event, $league,$season]);

        return view('pick.edit', compact('pick','event','league','season'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePickRequest $request, Pick $pick, League $league, Season $season, Event $event)
    {   
        $pick->update($request->validated());

        self::success($pick->name.' '.__('has been successfully updated'));

        return redirect(route('pick.show',$pick));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pick $pick)
    {
        $this->authorize('create',Pick::class);
        
        $pick->delete();

        self::success($pick->name.' '.__('has been successfully deleted'));

        return redirect(route('pick.index'));
    }

    public function adminCreate()
    {
        $this->authorize('adminCreate',[Pick::class]);

        return view('pick.admin-create');
    }

    public function adminEdit(Pick $pick)
    {
        $this->authorize('adminUpdate',$pick);

        return view('pick.admin-edit',compact('pick'));
    }
}
