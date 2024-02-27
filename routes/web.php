<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PickableController;
use App\Http\Controllers\PickController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home',[HomeController::class,'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pickable', PickableController::class);
    Route::resource('season', SeasonController::class);
    Route::resource('league', LeagueController::class);
    Route::get('/league/{league}/join', [LeagueController::class,'join'])->name('league.join');
    Route::resource('event', EventController::class);
    Route::get('/league/{league}/season/{season}/event/{event}/pick',[PickController::class, 'create'])->name('pick.create');
    Route::post('/league/{league}/season/{season}/event/{event}/pick',[PickController::class, 'store'])->name('pick.store');
    Route::get('/league/{league}/season/{season}/event/{event}/pick/{pick}/update',[PickController::class, 'edit'])->name('pick.edit');
    Route::patch('/league/{league}/season/{season}/event/{event}/pick/{pick}/update',[PickController::class, 'update'])->name('pick.update');
    Route::get('/pick',[PickController::class, 'index'])->name('pick.index');
});

require __DIR__.'/auth.php';
