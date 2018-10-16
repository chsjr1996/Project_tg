<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersTypeR extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_type_id', 
    ];
}
