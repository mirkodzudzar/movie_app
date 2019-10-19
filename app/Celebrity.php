<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Celebrity extends Model
{
  protected $fillable = [
    'first_name', 'last_name', 'date_of_birth', 'state_of_birth',
  ];

  // public function photos()
  // {
  //   return $this->morphMany('App\Photo', 'imageable');
  // }

  public function movies()
  {
    return $this->belongsToMany('App\Movie')
    ->withTimestamps();
  }

  public function getFullNameAttribute($value)
  {
     return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
  }
  //FIX COMA PROBLEM
  public function professions($id)
  {
      // $celebrity = DB::table('celebrities')->where('id', $id)->first();
      $celebrity_movies = DB::table('celebrity_movie')->where('celebrity_id', $id)->distinct()->get(['profession_id']);
      $numItems = count($celebrity_movies);
      $i = 0;
      foreach($celebrity_movies as $celebrity_movie)
      {
        $professions = DB::table('professions')->where('id', $celebrity_movie->profession_id)->get();
        foreach($professions as $profession)
        {
          if(++$i === $numItems)
          {
            echo $profession->name;
          }
          else
          {
            echo $profession->name.", ";
          }
        }
      }
  }
}
