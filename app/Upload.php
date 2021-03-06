<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {
	protected $fillable = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function server(){
        return $this->belongsTo('App\Server');
    }

}