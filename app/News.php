<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class News extends Model
{
    protected $fillable = [
      'title', 'content', 'user_id', 'photo_id'
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function photo()
    {
      return $this->belongsTo('App\Photo');
    }

    public function showNewsPhoto($id)
    {
      $news = DB::table('news')->where('id', $id)->first();
      if($news->photo_id == null)
      {
        return Photo::noPhoto();
      }
      else
      {
        $photo = DB::table('photos')->where('id', $news->photo_id)->first();
        return "/images/".$photo->file;
      }
    }
}
