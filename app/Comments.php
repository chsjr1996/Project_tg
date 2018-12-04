<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    /**
    * Fields that are mass assignable
    *
    * @var array
    */
    protected $fillable = ['user_id', 'profile_id', 'comment'];
}
