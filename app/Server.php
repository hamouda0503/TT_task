<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Server extends Model {
	protected $fillable = [
			'user_id',
			'platform_id',
			'name',
			'description',
			'cpu',
			'os',
			'os_ver',
			'ram',
			'stockage',
			'nbr_partition'

		];
	protected $hidden = [
			'created_at',
			'updated_at'
	];

	public function tasks(){
		return $this->hasMany('App\Task', 'server_id');
	}

	public function credentials(){
		return $this->hasMany('App\Credential', 'server_id');
	}

	public function members(){
		return $this->belongsToMany('App\User');
	}

    public function platform(){
        return $this->belongsTo('App\Platform');
    }

    public function uploads(){
        return $this->hasMany('App\Upload', 'server_id');
    }

	/**
	 * Checks if teh currently Auth user
	 * is the owner of the server.
	 *
	 * @return bool
	 */
	public function isOwner(){
		if($this->user_id != Auth::id()){
			return false;
		}

		return true;
	}


	/**
	 * Checks if the current Auth user
	 * is a member of a given server.
	 *
	 * @return bool
	 */
	public function isMember(){

		$s = DB::table('server_user')->whereServerId($this->id)->whereUserId(Auth::id())->get();
		if(count($s) == 0){
			return false;
		}

		return true;
	}

	// Get the toal weight of the given server
	public function totalWeight(){
		return $this->tasks()->where('state','!=','complete')->sum('weight');
	}
}