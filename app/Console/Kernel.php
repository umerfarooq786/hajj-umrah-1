<?php

namespace App\Console;

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
<<<<<<< HEAD
        $schedule->command('process:hotel-validity-notifications')->everyMinute();
        $schedule->command('process:transport-validity')->everyMinute();
=======
        // $schedule->command('process:hotel-validity-notifications')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('process:transport-validity')->everyFiveMinutes()->withoutOverlapping();
>>>>>>> f5302161d3e91f148269dfd593a45ca7d78eae05
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
