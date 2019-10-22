<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
      'file'
    ];

    protected $uploads = '/images/';

    public function getFileAttribute($image)
    {
      return $this->uploads . $image;
    }

    public static function noImage()
    {

      return 'http://denrakaev.com/wp-content/uploads/2015/03/no-image.png';

    }
}
