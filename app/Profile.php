<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function changeName($name) {
    	return $this->user()->update(['name' => $name]);
    }
}
