<?php

use App\Models\League;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PickController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PickableController;
use App\Http\Controllers\PickableOrderController;

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
    Route::get('season/{season}/order', [PickableOrderController::class, 'edit'])->name('order.edit');
    Route::patch('season/{season}/order', [PickableOrderController::class, 'update'])->name('order.update');
    Route::resource('season', SeasonController::class);
    Route::resource('league', LeagueController::class);
    Route::get('/league/{league}/join', [LeagueController::class,'join'])->name('league.join');
    Route::post('/join/league', [LeagueController::class,'code'])->name('league.code');
    Route::post('league/{league}/join/password', [LeagueController::class,'joinWithPassword'])->name('league.password');
    Route::resource('event', EventController::class);
    Route::get('/league/{league}/season/{season}/event/{event}/pick',[PickController::class, 'create'])->name('pick.create');
    Route::post('/league/{league}/season/{season}/event/{event}/pick',[PickController::class, 'store'])->name('pick.store');
    Route::get('/league/{league}/season/{season}/event/{event}/pick/{pick}/update',[PickController::class, 'edit'])->name('pick.edit');
    Route::patch('/league/{league}/season/{season}/event/{event}/pick/{pick}/update',[PickController::class, 'update'])->name('pick.update');
    Route::get('/pick/create',[PickController::class, 'adminCreate'])->name('pick.adminCreate');
    Route::post('/pick/create',[PickController::class, 'adminStore'])->name('pick.adminStore');
    Route::get('/pick/{pick}/update',[PickController::class, 'adminEdit'])->name('pick.adminEdit');
    Route::post('/pick/{pick}/update',[PickController::class, 'adminUpdate'])->name('pick.adminUpdate');
    Route::get('/pick',[PickController::class, 'index'])->name('pick.index');
    Route::delete('/pick/{pick}',[PickController::class,'destroy'])->name('pick.destroy');
    Route::resource('user',UserController::class);
    Route::get('/league/{league}/season/{season}/event/{event}/score',[EventController::class, 'score'])->name('event.score');
});

require __DIR__.'/auth.php';
