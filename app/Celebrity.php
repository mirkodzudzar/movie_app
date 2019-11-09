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

  public function images()
    {
      return $this->morphToMany('App\Image', 'imageable');
    }

  public function getFullNameAttribute($value)
  {
     return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
  }
  //FIX COMA PROBLEM AFTER DELETING SOME OF THE PROFESSIONS
  //Function for showing a professions for specific celebrity
  public function showProfessions($id)
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
            echo $profession->name.', ';
          }
        }
      }
  }

  public function celebritiesMovies($id, $profession_id)
  {
      // $movie = DB::table('movies')->where('id', $id)->first();
      $profession = DB::table('professions')->where('id', $profession_id)->first();
      // if($profession === null)
      // {
      //   echo "<i>profession unavailable</i>";
      // }
      // else
      // {
      $celebrity_movies = DB::table('celebrity_movie')->where('celebrity_id', $id)->where('profession_id', $profession->id)->get();

      $numItems = count($celebrity_movies);
      $i = 0;
      foreach($celebrity_movies as $celebrity_movie)
      {
        $movies = DB::table('movies')->where('id', $celebrity_movie->movie_id)->get();
        foreach($movies as $movie)
        {
          if(++$i === $numItems)
          {
            //LIMIT A NUMBER OF CELEBRITIES PER PROFESSION TO ONE PRESON
            // echo Str::words($celebrity->first_name.' '.$celebrity->last_name, $words = 1, $end = '...');
            echo '<a href="'.route('front.movies.show', $movie->id).'">'.$movie->name.'</a>';
          }
          else
          {
            echo '<a href="'.route('front.movies.show', $movie->id).'">'.$movie->name.'</a>, ';
          }
        // }
        }
      }
  }

  //Improving checkbox functionality when we editing a celebrity. This is a function for checking specific checkboxes thet are already saved in celebrity_movie table
  public function checkingCelebrity($movie_id, $celebrity_id, $profession_id)
  {
    $celebrity_movies = DB::table('celebrity_movie')->where('movie_id', $movie_id)->where('celebrity_id', $celebrity_id)->where('profession_id', $profession_id)->get();
    foreach($celebrity_movies as $celebrity_movie)
    {
      if($celebrity_movie == null)
      {
        return false;
      }
      else
      {
        return true;
      }
    }
  }
  //Function for showing first image for every celebrity, if it exist
  public function showCelebrityImage($id)
  {
    $imageable = DB::table('imageables')->where('imageable_id', $id)->where('imageable_type', 'App\Celebrity')->first();
    if($imageable == null)
    {
      return Image::noImage();
    }
    else
    {
      $image = DB::table('images')->where('id', $imageable->image_id)->first();
      return "/images/".$image->file;
    }
  }
}
