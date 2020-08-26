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
        return $this->belongsToMany(User::class,'ff_relationships','following_user_id','followed_user_id');
    }

    public function followed_relation(){
        return $this->belongsToMany(User::class,'ff_relationships','followed_user_id','following_user_id');
    }

    //全ユーザー取得
    public function getAllusers(Int $user_id){
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }

    //フォロー処理(インサート)
    //following_user_id -> 自分のuser_id,followed_user_id -> $user_id(相手のID)
    public function follow(Int $user_id){
        return $this->following_relation()->attach($user_id);
    }

    //フォロー解除処理(削除)
    public function unfollow(Int $user_id){
        return $this->following_relation()->detach($user_id);
    }

    //フォローしているかの判定
    //呼び出しUserモデルと$user_idの組み合わせでwhereがかかる(?)ので、フォローされている場合には一つのレコードのみ返ってくる(はず)
    //返り値=中間テーブルの対象レコードid or NULL
    public function following_judge(Int $user_id){
        return $this->following_relation()->where('followed_user_id',$user_id)->first(['ff_relationships.id']);
    }

    //フォローされているかの判定
    public function followed_judge(Int $user_id){
        return $this->followed_relation()->where('following_user_id',$user_id)->first(['ff_relationships.id']);
    }
}
