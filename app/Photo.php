<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
      'file'
    ];

    // protected $uploads = 'images';
    //
    // public function getFileAttribute($photo)
    // {
    //   return $this->uploads . $photo;
    // }

    // protected $uploads = '/images/';
    //
    // public function getFileAttribute($photo)
    // {
    //
    //   return $this->uploads . $photo;
    //
    // }

    // public function imageable()
    // {
    //   return $this->morphTo();
    // }

    public function user()
    {
      return $this->hasOne('App\User');
    }
}
