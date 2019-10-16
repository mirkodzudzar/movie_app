<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Celebrity extends Model
{
  protected $fillable = [
    'first_name', 'last_name', 'date_of_birth', 'place_of_birth',
  ];

  // public function movie()
  // {
  //   return $this->hasMany('App\Movie');
  // }

  // public function photos()
  // {
  //   return $this->morphMany('App\Photo', 'imageable');
  // }

  public function professions()
  {
    return $this->belongsToMany('App\Profession')
    ->withPivot('celebrity_id', 'celebrity_id')
    ->withPivot('profession_id', 'profession_id')
    ->withTimestamps();
  }

  public function movies()
  {
    return $this->belongsToMany('App\Movie')
    ->withPivot('celebrity_id', 'celebrity_id')
    ->withPivot('profession_id', 'profession_id')
    ->withTimestamps();
  }

  public function getFullNameAttribute($value)
  {
     return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
  }
}
