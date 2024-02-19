<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePickableRequest;
use App\Http\Requests\UpdatePickableRequest;
use App\Models\Pickable;

class PickableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Pickable::class);

        return view('pickable.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Pickable::class);

        return view('pickable.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePickableRequest $request)
    {
        $pickable = Pickable::create($request->validated());

        return redirect(route('pickable.show',$pickable));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pickable $pickable)
    {
        $this->authorize('view',$pickable);

        return view('pickable.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pickable $pickable)
    {
        $this->authorize('update',$pickable);

        return view('pickable.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePickableRequest $request, Pickable $pickable)
    {
        $pickable->update($request->validated());

        return redirect(route('pickable.show',$pickable));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pickable $pickable)
    {
        $this->authorize('delete',$pickable);

        $pickable->delete();

        return redirect(route('pickable.index'));
    }
}
