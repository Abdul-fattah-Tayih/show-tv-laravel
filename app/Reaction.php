<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $guarded = [];

    public const LIKE = 1;
    public const DISLIKE = 2;

    public function content()
    {
        return $this->belongsToMany('episodes', 'episode_reactions');
    }

    public function user()
    {
        return $this->belongsToMany('users', 'episode_reactions');
    }
}
