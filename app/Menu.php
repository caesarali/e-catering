<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $guarder = ['id', 'created_at', 'updated_at'];

    
}
