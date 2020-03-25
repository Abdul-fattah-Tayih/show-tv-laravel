<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $guarded = ['id'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function reactions()
    {
        return $this->belongsToMany(Reaction::class, 'episode_reactions')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    public function getLikes()
    {
        return $this->reactions()
            ->where('reaction_id', Reaction::LIKE)
            ->count();
    }

    public function getDislikes()
    {
        return $this->reactions()
            ->where('reaction_id', Reaction::DISLIKE)
            ->count();
    }

    public function getFormattedAirTimeAttribute()
    {
        return Carbon::parse($this->air_time)->format('d/m/Y @ g:i A');
    }

    public function getFormattedDurationAttribute()
    {
        return gmdate("H:i:s", $this->duration);
    }
}
