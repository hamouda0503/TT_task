<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serveruser extends Model {
	protected $fillable = [];
	protected $hidden = ['id','created_at', 'updated_at'];
	protected $table = 'server_user';

}