<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function menu() {
    	return $this->belongsTo('App\Menu');
    }
}
