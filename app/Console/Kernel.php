<?php

namespace App\Console;

use App\Console\Commands\StramingData;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        StramingData::class
    ];

    /**
     * Define the application's command storage.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

//        $schedule->command('streaming:data')
//            ->everyMinute()
//            ->sendOutputTo('public/storage/scheduler-log.txt')
//            ->emailOutputOnFailure('mergimuka1@gmail.com');


        $schedule->command('streaming:chart')
            ->everyMinute()
            ->sendOutputTo('public/storage/chart-streaming-log.txt')
            ->emailOutputOnFailure('mergimuka1@gmail.com');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
