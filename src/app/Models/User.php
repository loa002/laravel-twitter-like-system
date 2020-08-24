<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'handle_name' ,'image_picture' ,'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //リレーション定義
    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function favorite(){
        return $this->hasMany(Favorite::class);
    }

    public function laraat(){
        return $this->hasMany(Laraat::class);
    }

    public function following_relation(){
        return $this->belongsToMany(User::class,'ff_relationship','following_user_id','followed_user_id');
    }

    public function fllowed_relation(){
        return $this->belongsToMany(User::class,'ff_relationship','followed_user_id','following_user_id');

    }

    //全ユーザー取得
    public function getAllusers(Int $user_id){
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }
}
