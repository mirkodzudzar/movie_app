<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Profession extends Model
{
    protected $fillable = [
      'name',
    ];

    public function celebrities()
    {
      return $this->belongsToMany('App\Celebrity')
      ->withPivot('celebrity_id', 'celebrity_id')
      ->withPivot('profession_id', 'profession_id')
      ->withTimestamps();
    }

    public function actorByProfessionCount($id)
    {
      return DB::table('celebrity_profession')->where('profession_id', $id)->count();
    }
}
