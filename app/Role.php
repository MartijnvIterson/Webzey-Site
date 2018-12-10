<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $with = ['users'];
    protected $fillable = ['name', 'display_name', 'description', 'color'];
    protected $table = 'roles';
    function getRouteKeyName()
    {
        return 'name';
    }
    public function comments() {
        return $this->hasMany('App\User');
    }

}
