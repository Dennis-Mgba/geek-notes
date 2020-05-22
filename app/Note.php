<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
