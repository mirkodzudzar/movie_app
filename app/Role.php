<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    protected $fillable = [
      'name',
    ];

    //Returning a number of users with specific id of role
    public function userByRoleCount($id)
    {
      return DB::table('users')->where('role_id', $id)->count();
    }

    public function users()
    {
      return $this->hasMany('App\User');
    }
}
