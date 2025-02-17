<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\League;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user())
        {
            redirect('/');
        }
        $leagues = auth()->user()->leagues;
        $availableLeagues = League::joinable(auth()->user())->public()->get();
        return view('home', compact('leagues','availableLeagues'));
    }
}
