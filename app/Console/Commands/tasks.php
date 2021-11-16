<?php

namespace App\Console\Commands;
use DB ;
use App\Task;
use Illuminate\Console\Command;

class tasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $CSVFile = public_path('tasks.csv');
        if(!file_exists($CSVFile) || !is_readable($CSVFile))
            return false;

        $header = null;
        $data = array();

        if (($handle = fopen($CSVFile,'r')) !== false){
            while (($row = fgetcsv($handle, 1000, ',')) !==false){
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        $dataCount = count($data);
        for ($i = 0; $i < $dataCount; $i ++){
            Task::firstOrCreate($data[$i]);
        }
        echo "task  data added successfully"."\n";
    }
}
