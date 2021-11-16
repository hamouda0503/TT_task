<?php

namespace App\Http\Controllers;

use App\Serveruser;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Server;
use App\Task;
use App\Credential;
use App\Helpers\Helpers;
use ConsoleTVs\Charts\Facades\Charts;

class ServersController extends BaseController {

	// Returns the given server view
	public function show($id)
	{   	
		$server 		=	Server::find($id);



        // Must be refactored as a filter
		if ( $server->isOwner() == false && $server->isMember() == false ) {
			return Redirect::to('/hud');
		}

		return  View::make('ins/servers/show')->with('pTitle', $server->name);
	}


	// Get all user servers
	public function getAllUserServers(){
		$servers = Server::where('user_id',Auth::id())->get();

		if($servers) {
			foreach ($servers as $server) {
				$completedWeight = Server::find($server->id)->tasks()->where('state','=','complete')->sum('weight');
				$totalWeight = Server::find($server->id)->tasks()->sum('weight');

				$server["completedWeight"] = $completedWeight;
				$server["totalWeight"] = $totalWeight;
			}
		}

		return $this->setStatusCode(200)->makeResponse('Servers retrieved successfully',$servers->toArray());
	}

    // Get all servers that the Auth user is a member of
	public function getAllMemberServers(){
        $sharedServers = Serveruser::where('user_id', Auth::id())->select('server_id')->get();
        $server_ids = [];

        foreach($sharedServers as $server){
            $server_ids[] = $server->server_id;
        }

        $sharedServers = Server::whereIn('id', $server_ids)->get();

        if($sharedServers) {
            foreach ($sharedServers as $server) {
                $completedWeight = Server::find($server->id)->tasks()->where('state','=','complete')->sum('weight');
                $totalWeight = Server::find($server->id)->tasks()->sum('weight');

                $server["completedWeight"] = $completedWeight;
                $server["totalWeight"] = $totalWeight;
            }
        }
        return $this->setStatusCode(200)->makeResponse('Servers retrieved successfully',$sharedServers);
    }

	//	Return the given server
	public function getServer($id){
		if (!Server::find($id)) {
			return $this->setStatusCode(404)->makeResponse('The server was not found');
		}

		$server = Server::find($id);
		$server->tasks = Task::where('server_id', $id)->get();
		$server->credentials = Credential::where('server_id', $id)->get();

		
		return $this->setStatusCode(200)->makeResponse('Server was successfully found', $server);
		
	}
	

	

	// Insert the given server into the database
	public function storeServer(){
		if (!Input::all() || strlen(trim(Input::get('name'))) == 0) {
			return $this->setStatusCode(406)->makeResponse('No information provided to create server');
		}

		Input::merge(array('user_id' => Auth::id()));
		Server::create(Input::all());
		$id = \DB::getPdo()->lastInsertId();

		return $this->setStatusCode(200)->makeResponse('Server created successfully', Server::find($id));
	}

	// Update the given server
	public function updateServer($id){
		if ( Input::get('name') === "") {
			return $this->setStatusCode(406)->makeResponse('The server needs a name');
		}

		if (!Server::find($id)) {
			return $this->setStatusCode(404)->makeResponse('Server not found');
		}

		$input = Input::all();
		unset($input['_method']);

		Server::find($id)->update($input);
		return $this->setStatusCode(200)->makeResponse('The server has been updated');
	}

    public function getOwner($id){
        $owner_id = Server::whereId($id)->pluck('user_id');
        $owner = User::whereId($owner_id)->get();

        return $this->setStatusCode(200)->makeResponse('ok.', $owner[0]);
    }

    public function getMembers($id){
        $members_id = Serveruser::where('server_id', $id)->lists('user_id');
        $members = [];

        foreach($members_id as $id){
            $member = User::whereId($id)->get();
            array_push($members, $member[0]);
        }

        return $this->setStatusCode(200)->makeResponse('ok.', $members);
    }
    // Invites a user to the given server.
	public function invite($server_id, $email){
        if(trim(strlen($email)) == 0){
            return $this->setStatusCode(406)->makeResponse('The email field is required!');
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->setStatusCode(406)->makeResponse('Please enter a valid email!');
        }

        $server_name	= Server::find($server_id)->pluck('name');
        $owner_id	    = Server::find($server_id)->pluck('user_id');
        $server_url 	= url() . '/servers/'.$server_id;
        $invited_user   = User::whereEmail($email)->get();

        if( count($invited_user) == 0 ){
            return $this->setStatusCode(406)->makeResponse('That user does not have an account.');
        }
        $invited_user = $invited_user[0];

        if( count(Serveruser::whereUserId($invited_user->id)->whereServerId($server_id)->get()) != 0 ){
			return $this->setStatusCode(406)->makeResponse('A user with that email has already been invited.');
		}

        if(Auth::id() != $owner_id){
            return $this->setStatusCode(406)->makeResponse('Only the server owner can invite a user.');
        }
		// Save the relationship between user and server.
		$pu				= 	new Serveruser();
		$pu->server_id	=	$server_id;
		$pu->user_id	=	$invited_user->id;
		$pu->save();

		Helpers::sendServerInviteMail($email, $server_name, $server_url);
		return $this->setStatusCode(200)->makeResponse('A new member has been added to this server.', $invited_user);
	}

    // Removes a member from a given server
	public function removeMember($server_id, $member_id){
		if( count(Serveruser::whereUserId($member_id)->whereServerId($server_id)->get()) == 0 ){
			return $this->setStatusCode(406)->makeResponse('That user is not in this server.');
		}

		$server = Server::find($server_id);
		$server->members()->detach($member_id);

		return $this->setStatusCode(200)->makeResponse('Member has been removed from this server.');
	}


	//********************************************************************* */
	// public function files($id){
    //     $server  = Server::find($id);
    //     $owner_id =	$server->user_id;
    //     $total_weight	=	$server->tasks()->where('state','incomplete')->sum('weight');
    //     $members 		= 	$server->members()->get();

    //     $pTitle   = $server->name . " files";

    //     return View::make('servers.files', compact(
    //                                         [
    //                                             'server',
    //                                             'total_weight',
    //                                             'owner_id',
    //                                             'members',
    //                                             'pTitle'
    //                                         ]));
    // }
	//********************************************************************* */


}