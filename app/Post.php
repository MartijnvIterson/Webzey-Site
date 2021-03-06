<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $with = ['comments', 'user'];
    protected $fillable = ['user_id', 'message', 'title', 'slug'];
    protected $table = 'posts';
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
    function getRouteKeyName()
    {
        return 'slug';
    }
}
