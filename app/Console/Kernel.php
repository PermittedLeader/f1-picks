<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use App\Mail\NotPickedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function(){
            $eventInstances = Event::query()
                ->join(
                    'event_season',
                    'events.id',
                    "=",
                    'event_season.event_id'
                )->join(
                    'league_season',
                    'event_season.season_id',
                    "=",
                    'league_season.season_id'
                )->where(
                    'pick_date',
                    '<=',
                    Carbon::now()->addDays(2)
                )->where(
                    'pick_date',
                    '>=',
                    Carbon::now()
                )->get();
        
            foreach($eventInstances as $event){
                $users = User::whereHas('leagues', function($query) use ($event){
                    $query->where('id',$event->league_id);
                })->whereDoesntHave('picks', function($query) use ($event){
                    $query->where('event_id',$event->event_id);
                    $query->where('league_id',$event->league_id);
                    $query->where('season_id',$event->season_id);
                })->get();
        
                foreach($users as $user)
                {
                    Mail::to($user)->queue(new NotPickedEmail($event, Season::find($event->season_id), League::find($event->league_id)));
                }
            }
        })->dailyAt('03:00')->environments('production');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
