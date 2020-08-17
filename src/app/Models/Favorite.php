<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function laraat(){
        return $this->belongsTo(Laraat::class);
    }
}
