<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
  protected $fillable = [
    'value', 'movie_id',
  ];

  public function movie()
  {
      return $this->belongsTo('App\Movie');
  }
}
