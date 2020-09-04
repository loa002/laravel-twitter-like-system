<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Comment extends Model
{
    use SoftDeletes; //論理削除機能

    protected $fillable = [
        'txt_content',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function laraat(){
        return $this->belongsTo(Laraat::class);
    }

    public function getComments(Int $laraat_id){
        return $this->with('user')->where('laraat_id',$laraat_id)->get();
    }

    public function commentRegister(Int $user_id, Array $comment_data){
        $this->user_id = $user_id;
        $this->laraat_id = $comment_data['laraat_id'];
        $this->txt_content = $comment_data['txt_content'];
        $this->save();

        return;
    }
}
