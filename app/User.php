<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'date_of_birth', 'state_of_birth', 'username', 'email', 'password', 'role_id', 'photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
      if($this->role !== null)
      {
        if($this->role->name == "administrator")
        {
            return true;
        }
      }

      return false;
    }

    public function isAuthor()
    {
      if($this->role !== null)
      {
        if($this->role->name == "author")
        {
            return true;
        }
      }

      return false;
    }

    public function getFullNameAttribute($value)
    {
       return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function photo()
    {
      return $this->belongsTo('App\Photo');
    }

    public function movies()
    {
      return $this->belongsToMany('App\Movie')
      ->withPivot('like', 'like')
      ->withTimestamps();
    }

    public function news()
    {
      return $this->hasMany('App\News');
    }
}
