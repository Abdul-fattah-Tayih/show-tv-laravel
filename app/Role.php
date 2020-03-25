<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];

    public const ADMIN_ROLE = 1;
    public const USER_ROLE = 2;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
