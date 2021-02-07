<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;

    // Task belongs to User
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
