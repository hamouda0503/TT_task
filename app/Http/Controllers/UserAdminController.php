<?php

namespace App\Http\Controllers;
use App\Platform;
use App\Server;
use App\Task;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class UserAdminController extends BaseController {

    /**
     * Takes you to the admin page of the app
     * @return mixed
     */
    public function index(){
        if( Auth::user()->matricule != env('ADMIN_MAT') ){
            return Redirect::back();
        }

        $users = User::all();
        
        $tasks = Task::all();
        $servers = Server::all();
        $platforms = Platform::all();

        return View::make('ins/gestion/users')
            ->with('pTitle', 'Admin')
            ->with('users', $users)
            ->with('tasks', $tasks)
            ->with('servers', $servers)
            ->with('platforms', $platforms);
     
    }
    public function index1(){
        if( Auth::user()->matricule != env('ADMIN_MAT') ){
            return Redirect::back();
        }

        $users = User::all();
        
        $tasks = Task::all();
        $servers = Server::all();
        $platforms = Platform::all();

        return View::make('ins/gestion/servers')
            ->with('pTitle', 'Admin')
            ->with('users', $users)
            ->with('tasks', $tasks)
            ->with('servers', $servers)
            ->with('platforms', $platforms);
     
    }
    public function index2(){
        if( Auth::user()->matricule != env('ADMIN_MAT') ){
            return Redirect::back();
        }

        $users = User::all();
        
        $tasks = Task::all();
        $servers = Server::all();
        $platforms = Platform::all();

        return View::make('ins/gestion/platforms')
            ->with('pTitle', 'Admin')
            ->with('users', $users)
            ->with('tasks', $tasks)
            ->with('servers', $servers)
            ->with('platforms', $platforms);
     
    }
    public function index3(){
        if( Auth::user()->matricule != env('ADMIN_MAT') ){
            return Redirect::back();
        }

        $users = User::all();
        
        $tasks = Task::all();
        $servers = Server::all();
        $platforms = Platform::all();

        return View::make('ins/gestion/tasks')
            ->with('pTitle', 'Admin')
            ->with('users', $users)
            ->with('tasks', $tasks)
            ->with('servers', $servers)
            ->with('platforms', $platforms);
     
    }

}