<?php

namespace App\Http\Controllers;
use App\Platform;
use App\Server;
use App\Task;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AdminController extends BaseController {

    /**
     * Takes you to the admin page of the app
     * @return mixed
     */
    public function index(){
        if( Auth::user()->matricule != env('ADMIN_MAT') ){
            return Redirect::back();
        }

        $users = User::all();
        $n_users = count($users);
        $n_tasks = Task::all()->count();
        // $n_tasks1 = TaskDB::select(     , [1]) 

        $n_servers = Server::all()->count();
        $n_platforms = Platform::all()->count();

        return View::make('admin/index')
            ->with('pTitle', 'Admin')
            ->with('users', $users)
            ->with('n_users', $n_users)
            ->with('n_tasks', $n_tasks)
            ->with('n_servers', $n_servers)
            ->with('n_platforms', $n_platforms);

    }

}