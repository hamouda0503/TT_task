<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Server;

/**
 * Class Helpers
 * @package App\Helpers
 */
class Helpers {

	// Return the image logo path
	static public function logoUrl(){
		return asset('assets/img/logo.png');
	}
	static public function logoUrlm(){
		return asset('assets/img/logo5.png');
	}

	// Checks if the given user is the owner of the server
	static function isOwner($server_id, $user_id = null) {

		if($user_id == null){
			$user_id = Auth::id();
		}

		$s = Server::whereId($server_id)->whereUserId($user_id)->get();

		if(count($s) == 0){
			return false;
		}

		return true;
	}


	/*******************************
			MAIL FUNCTIONS
	********************************/

	// Send the welcome email to the user
	static function sendWelcomeMail() {
		$data = [
				'to' 	=> Auth::user()->email,
				'name' 	=> Auth::user()->full_name
		];

		Mail::send('emails.welcome', [ 'name' => $data['name'] ] , function($message) use ($data){
			$message->from(getenv('MAIL_FROM'), getenv('MAIL_FROM_NAME'));
	        $message->to($data['to'], $data['name'] )->subject('Welcome to TT');
		});
	}

	/** Sends password changed email **/

	/** Sends account deletion email **/

	// Send server invite email
	static function sendServerInviteMail($email, $server_name, $server_url) {
		$data = [ 'to' => $email ];

		Mail::send('emails.serverInvite', [ 'server_url' => $server_url, 'server_name' => $server_name ] , function($message) use ($data) {
			$message->from(getenv('MAIL_FROM'), getenv('MAIL_FROM_NAME'));
			$message->to($data['to'], '')->subject('You have been invited to a new server');
		});
	}
}