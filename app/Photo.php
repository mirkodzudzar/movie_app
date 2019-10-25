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

    protected $uploads = '/images/';

    public function getFileAttribute($photo)
    {
      return $this->uploads . $photo;
    }

    public function user()
    {
      return $this->hasOne('App\User');
    }

    public function news()
    {
      return $this->hasOne('App\News');
    }

    public static function noPhoto()
    {

      return 'http://denrakaev.com/wp-content/uploads/2015/03/no-image.png';

    }
}
