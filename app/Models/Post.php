<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'category_id', 'user_id','content','thumbnail','status'
    ];
    public function category(){
        return $this->belongsTo(Category::class)->select('id','name');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
