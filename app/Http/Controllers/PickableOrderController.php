<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class PickableOrderController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Season $season)
    {
        $this->authorize('update',$season);

        $season = Season::find($season->id)->with('pickables')->first();

        return view('season.order.edit', compact('season'));
    }
}
