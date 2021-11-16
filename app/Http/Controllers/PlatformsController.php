<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Platform;
use App\Server;
use App\Task;
use App\Credential;
use Illuminate\Support\Facades\Redirect;


class PlatformsController extends BaseController {

   
	// Go to platforms index page
	public function index()
	{	
        if( Auth::user()->matricule != env('ADMIN_MAT') ){
            return Redirect::back();}
		return View::make('ins/platforms/index')->with("pTitle", "Platforms");
	}

    // Get all platforms for the given user
    public function getAllUserPlatforms($withWeight = false){
        $platforms = Platform::with('servers')->where('user_id',Auth::id())->get();

        if (count($platforms) === 0) {
            return $this->setStatusCode(400)->makeResponse('Could not find platforms');
        }

        // Get each server total weight if needed
        if($withWeight == true){
            if($platforms) {
                foreach ($platforms as $platform) {
                    if($platform->servers){
                        foreach($platform->servers as $server){
                            $weight = Server::find($server->id)->tasks()->where('state','!=','complete')->sum('weight');
                            $server["weight"] = $weight;
                        }
                    }
                }
            }
        }
        return $this->setStatusCode(200)->makeResponse('Platforms retrieved successfully',$platforms->toArray());
    }

    // Insert a new platform into the database
    public function storePlatform(){

        if (  strlen(trim(Input::get('name'))) == 0) {
            return $this->setStatusCode(400)->makeResponse('Name field is required');
        }

        Input::merge(array('user_id' => Auth::id()));
        Platform::create(Input::all());
        $id = \DB::getPdo()->lastInsertId();

        return $this->setStatusCode(200)->makeResponse('Platform created successfully', Platform::find($id));
    }

    // Update the given platform
    public function updatePlatform($id){
        if (count(Input::all()) <= 1) {
            return $this->setStatusCode(406)->makeResponse('No information provided to update platform');
        }

        if( strlen(trim(Input::get('name'))) === 0 ){
            return $this->setStatusCode(406)->makeResponse('The platform name is required');
        }

        if (!Platform::find($id)) {
            return $this->setStatusCode(404)->makeResponse('Platform not found');
        }

        $input = Input::all();
        unset($input['_method']);

        Platform::find($id)->update($input);

        return $this->setStatusCode(200)->makeResponse('The platform has been updated');
    }

    // Remove the given platform and all tasks, servers and credentials attached to it
    public function removePlatform($id){
        if (!Platform::find($id)) {
            return $this->setStatusCode(400)->makeResponse('Could not find the platform');
        }

        $platform 	= 	Platform::find($id);

        // delete all related tasks and credentials
        foreach ($platform->servers as $p) {
            Task::where('server_id', $p->id)->delete();
            Credential::where('server_id', $p->id)->delete();
            $p->members()->detach();
        }

        // delete servers
        Server::where("platform_id", $id)->delete();
        $platform->delete();
        return $this->setStatusCode(200)->makeResponse('Platform deleted successfully');
    }

}