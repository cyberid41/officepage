<?php namespace App\Console;

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
        'App\Console\Commands\RepositoryCommand',
        'App\Console\Commands\ModelCommand',
        'App\Console\Commands\FormRequestCommand',
        'App\Console\Commands\ControllerCommand',
        'App\Console\Commands\InterfaceCommand',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
            ->hourly();
    }

}
