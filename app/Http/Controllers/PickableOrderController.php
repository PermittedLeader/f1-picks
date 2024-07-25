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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Season $season)
    {
        $this->authorize('update',$season);

        foreach($request->input('pickable') as $pickable_id => $order){
            $season->pickables()->updateExistingPivot($pickable_id,['order'=>$order]);
        }

        self::success($season->name.' '.__('pickable order has been successfully updated'));

        return redirect(route('season.show',$season));
    }
}
