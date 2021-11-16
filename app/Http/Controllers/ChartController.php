<?php

namespace App\Http\Controllers;

use App\Server;
use ConsoleTVs\Charts\Facades\Charts;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ChartController extends Controller
{
    public function index()
    {
        $user         =     User::find(Auth::id());

        $tasks         =     $user->tasks()->get();
        $tasks2         =     $user->tasks()->whereState("complete")->get();
        $tasks1         =     $user->tasks()->whereState("progress")->get();
        $taskCount         =    count($tasks);
        $taskCount1         =    count($tasks2);
        $taskCount2 =    count($tasks1);

        // $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
        // 			->get();
        $chart = Charts::create('pie', 'highcharts')
            ->title('My nice chart')
            ->labels(['all tassk', 'completed', 'progress'])
            ->values([$taskCount, $taskCount1,    $taskCount2])
            ->dimensions(1000, 500)
            ->responsive(false);

        $chart1 = Charts::create('line', 'highcharts')
            ->title('My nice chart')
            ->elementLabel('My nice label')
            ->labels(['all tassk', 'completed', 'progress'])
            ->values([$taskCount, $taskCount1,    $taskCount2])
            ->dimensions(1000, 500)
            ->responsive(false);
            
        return view('chart', compact('chart','chart1'));
    }
}
