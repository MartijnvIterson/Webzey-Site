<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $with = ['user'];
    protected $fillable = ['user_id', 'message', 'post_id'];
    protected $table = 'comments';
    function getRouteKeyName()
    {
        return 'id';
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}
