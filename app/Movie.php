<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
      'name', 'description', 'time_duration', 'release_date', 'director_id', 'genre_id',
    ];

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function director()
    {
      return $this->belongsTo('App\Director');
    }
}
