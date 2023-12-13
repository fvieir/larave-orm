<?php

namespace App\Models;

use App\Models\Accessors\DefaultAccessors;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, DefaultAccessors;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'data',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function scopeToday(Builder $query): void
    {
        $today = Carbon::now()->format('Y-m-d');

        $query->where('created_at', '>=', $today);
    }

    public function scopeLastWeek(Builder $query): void
    {
        $firstDate = Carbon::now()->format('Y-m-d');
        $lastDate = Carbon::now()->subDays(7)->format('Y-m-d');

        $query->whereBetween('created_at', [$lastDate, $firstDate]);
    }

    public function scopeBetween(Builder $query, $fisrtDate, $lastDate): void
    {
        $fisrtDate = Carbon::make($fisrtDate)->format('Y-m-d');
        $lastDate = Carbon::make($lastDate)->format('Y-m-d');

        $query->whereDate('created_at', '>=', $fisrtDate)
            ->whereDate('created_at', '<=', $lastDate);
    }
}
