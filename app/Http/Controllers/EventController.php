<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Event::class);

        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Event::class);

        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $this->authorize('create',Event::class);

        $event = Event::create($request->validated());

        return redirect(route('event.show',$event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $this->authorize('view',$event);

        return view('event.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update',$event);

        return view('event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $event->update($request->validated());

        return redirect(route('event.show',compact('event')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete',$event);

        $event->delete();

        return redirect()->back();
    }

    public function score(League $league, Season $season, Event $event)
    {
        $this->authorize('score',[$event,$league,$season]);

        return view('event.score',compact('event','season','league'));
    }
}
