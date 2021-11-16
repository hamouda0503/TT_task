<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model {

	protected $table = 'platforms';
	protected $hidden = ['created_at','updated_at'];
	protected $fillable = [
		'user_id',
		'name',
		'description'
		
	];

	/**
	 * Return the related servers for a given platform
	 */
	public function servers() {
        return $this->hasMany('App\Server', 'platform_id');
    }
}