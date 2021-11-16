<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Task;
use App\Server;
use App\User;
use Illuminate\Support\Facades\Input;
use App\Platform;
use ConsoleTVs\Charts\Facades\Charts;


class HomeController extends BaseController
{

	// Depending if the user is signed in or not, return the home page 
	public function index()
	{
		if (Auth::check()) {
			$user 		= 	User::find(Auth::id());

			$tasks3 		= 	$user->tasks()->whereState("testing")->get();
			$tasks2 		= 	$user->tasks()->whereState("complete")->get();
			$tasks1 		= 	$user->tasks()->whereState("progress")->get();
			$taskCount 		=	count($tasks3);
			$taskCount1 		=	count($tasks2);
			$taskCount2 =	count($tasks1);

			$chart = Charts::create('donut', 'highcharts')
				->title('Task stats')
				->labels(['testing', 'completed', 'progress'])
				->values([$taskCount, $taskCount1,	$taskCount2])
				->dimensions(650, 500)
				->responsive(false);

				$chart1 = Charts::create('bar', 'highcharts')
				->title('My nice chart')
				->elementLabel('My nice label')
				->labels(['all tassk', 'completed', 'progress'])
				->values([$taskCount, $taskCount1,    $taskCount2])
				->dimensions(1000, 500)
				->responsive(false);
				


			return View::make('ins/hud', compact('chart','chart1'))->with('pTitle', "Hud");
		} else {
			return View::make('index')->with('pTitle', "A server management system for artisans");
		}
	}

	// Search for, platforms, servers, and tasks
	public function search()
	{
		$q = Input::get("q");

		// redirect user back if nothing was typed
		if (empty(trim($q))) {
			return Redirect::back();
		}

		$platforms = Platform::where('name', 'like', '%' . $q . '%')->whereUserId(Auth::id())->get();
		$servers = Server::where('name', 'like', '%' . $q . '%')->whereUserId(Auth::id())->get();
		$tasks = Task::where('name', 'like', '%' . $q . '%')->whereUserId(Auth::id())->get();
		$pTitle = "Search Results";

		return View::make('ins/search', compact('q', 'platforms', 'servers', 'tasks', 'pTitle'));
	}
}
