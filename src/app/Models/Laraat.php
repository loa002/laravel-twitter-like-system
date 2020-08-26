<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Laraat extends Model
{
    use SoftDeletes; //論理削除機能

    protected $fillable = [
        'txt_content',
    ];
    //fillableについて…ユーザー入力値対象の保護なので、外部キーなどシステムから譲渡される値は対象外になるみたい

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favorite(){
        return $this->hasMany(Favorite::class);
    }

    public function getAlllaraats(Int $user_id){
        return $this->where('user_id',$user_id)->paginate(50);
    }

    public function getLaraatscount(Int $user_id){
        return $this->where('user_id',$user_id)->count();
    }
}
