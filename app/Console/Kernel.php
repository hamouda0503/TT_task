<?php

namespace App\Console;
use DB ;
use App\Task;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\tasks::class,
        \App\Console\Commands\Deletetasks::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   

        // $schedule->call(function () {
        //     DB::table('tasks')->where('state','backlog')->delete();
        // })->everyFiveMinutes();

        // $schedule->call(function () {
        //    $CSVFile = public_path('tasks.csv');
        // if(!file_exists($CSVFile) || !is_readable($CSVFile))
        //     return false;

        // $header = null;
        // $data = array();

        // if (($handle = fopen($CSVFile,'r')) !== false){
        //     while (($row = fgetcsv($handle, 1000, ',')) !==false){
        //         if (!$header)
        //             $header = $row;
        //         else
        //             $data[] = array_combine($header, $row);
        //     }
        //     fclose($handle);
        // }

        // $dataCount = count($data);
        // for ($i = 0; $i < $dataCount; $i ++){
        //     Task::firstOrCreate($data[$i]);
        // }
        // echo "task  data added successfully"."\n";
        //    })->everyMinute();
       
        // $schedule->command('inspire')
        //          ->hourly();
        // $schedule->command('del:tasks')->everyFiveMinutes();
        $schedule->command('add:tasks')->everyMinute();
        
        // $schedule->command('backup:clean')->daily()->at('01:00');
        // $schedule->command('backup:run')->daily()->at('02:00');
    }
//     /**
//      * Register the commands for the application.
//      *
//      * @return void
//      */
//     protected function commands()
//     {
//         $this->load(__DIR__.'/Commands');

//         include base_path('routes/console.php');
//     }
// }
}