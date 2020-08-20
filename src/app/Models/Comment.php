<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Comment extends Model
{
    use SoftDelete; //論理削除機能

    protected $fillable = [
        'txt_content',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function laraat(){
        return $this->belongsTo(Laraat::class);
    }
}
