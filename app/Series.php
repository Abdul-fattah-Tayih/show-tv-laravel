<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $guarded = ['id'];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function followingUsers()
    {
        return $this->belongsToMany(User::class, 'user_series')->withTimestamps();
    }

    public function getLatestEpisodeThumbnailAttribute()
    {
        $episode = $this->episodes()->first();
        return optional($episode)->thumbnail;
    }

    public function getFromDayAttribute()
    {
        return json_decode($this->air_time)->from_day;
    }

    public function getToDayAttribute()
    {
        return json_decode($this->air_time)->to_day;
    }

    public function getTimeAttribute()
    {
        return Carbon::parse(json_decode($this->air_time)->time)->format('g:i A');
    }
}
