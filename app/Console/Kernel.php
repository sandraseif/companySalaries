<?php

namespace App\Console;

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
        $first_day_this_month = date('Y-m-01');
        $firstDayThisMonth    = new \DateTime($first_day_this_month);
        $lastDayThisMonth     = new \DateTime($firstDayThisMonth->format('Y-m-t'));
        $lastDayThisMonth->setTime(23, 59, 59);
        $nameOfLastDay = date('D', strtotime($lastDayThisMonth->format("Y-m-d")));
     
        if($nameOfLastDay == 'Fri'){
            $salaryDay   =   date('d', strtotime('-3 day', strtotime($lastDayThisMonth->format("Y-m-d"))));
        }else if($nameOfLastDay == 'Sat') {
            $salaryDay   = date('d', strtotime('-4 day', strtotime($lastDayThisMonth->format("Y-m-d"))));
        }else{
            $salaryDay   = date('d', strtotime('-2 day', strtotime($lastDayThisMonth->format("Y-m-d"))));
        }
            
       $schedule->call('App\Http\Controllers\MainController@basic_email')->monthlyOn($salaryDay);
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
