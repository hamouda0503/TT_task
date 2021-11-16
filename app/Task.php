<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
	protected $fillable = [
        'name',
        'weight',
        'user_id',
        'server_id',
        'state',
        'priority',
        'description',
        'dueDate'
    ];

    protected  $hidden = [
        "created_at",
        "updated_at",
    ];

    /**
     * Relationship to server
     */
    public function server(){
        return $this->belongsTo('App\Server', 'server_id');
    }
}

