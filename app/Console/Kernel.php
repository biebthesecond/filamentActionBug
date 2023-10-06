<?php

namespace App\Console;

use App\Jobs\DeleteTemporaryUploadedFilesJob;
use App\Jobs\SendPeriodicRequestsJob;
use App\Jobs\SendRequestReminderJob;
use App\Jobs\SendRequests;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('messages:clean')->hourly();
         $schedule->job(New DeleteTemporaryUploadedFilesJob)->everyFiveMinutes();
         $schedule->job(New SendRequests())->everyMinute();

         /*Daily*/
         $schedule->job(New SendPeriodicRequestsJob())->daily();
         $schedule->job(New SendRequestReminderJob())->daily();
         /*End Daily*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/Commands/Messages');

        require base_path('routes/console.php');
    }
}
