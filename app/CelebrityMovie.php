<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CelebrityMovie extends Pivot
{
    public function celebrity()
    {
        return $this->belongsTo('App\Celebrity');
    }

    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }

    public function profession()
    {
        return $this->belongsTo('App\Profession');
    }
  }
