<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $guarded = ['id'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function getFormattedAirTimeAttribute()
    {
        return Carbon::parse($this->air_time)->format('l, g:i A');
    }
}
