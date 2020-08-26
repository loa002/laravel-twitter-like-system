<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ff_relationship extends Model
{
    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    public function getFollowingcount(Int $user_id){
        return $this->where('following_user_id',$user_id)->count();
    }

    public function getFollowedcount(Int $user_id){
        return $this->where('followed_user_id',$user_id)->count();
    }
    
}
