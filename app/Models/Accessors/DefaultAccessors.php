<?php

namespace App\Models\Accessors;

use Carbon\Carbon;

trait DefaultAccessors
{
    public function getTitleAttribute($value)
    {
        return strtoupper($value);
    }

    public function getTitleAndBodyAttribute()
    {
        return $this->title . ' - ' . $this->body;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::make($value)->format('d-m-Y');
    }
}
