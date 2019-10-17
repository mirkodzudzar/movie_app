<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\CelebrityMovie;

class Profession extends Model
{
    protected $fillable = [
      'name',
    ];

    // public function celebrities()
    // {
    //   return $this->belongsToMany('App\Celebrity')
    //   ->withTimestamps();
    // }

    public function celebrityMovies()
    {
      return $this->hasMany('App\CelebrityMovie');
    }

    // public function actorByProfessionCount($id)
    // {
    //   return DB::table('celebrity_profession')->where('profession_id', $id)->count();
    // }

    //Number of specific profession in celebrity_movie table. This function needs to bee improved to show distinct values of celebrity_id.NOT WORKING YET
    public function numberOfCelebrities($id)
    {
        $profession = DB::table('professions')->where('id', $id)->first();
        $celebrity_movie = CelebrityMovie::distinct('celebrity_id')->where('profession_id', $profession->id)->get();
        return $celebrity_movie->count();

    }
}
