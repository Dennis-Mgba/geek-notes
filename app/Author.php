<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function notes()
    {   // create a one author to many notes relationship between the authors table and the notes table
        return $this->hasMany('App\Note');  // ie one author can have many notes  -- go set the inverse in the Note model
    }
}
