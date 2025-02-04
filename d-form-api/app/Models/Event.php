<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'cover_event',
        'address',
        'map_url',
        'gform_url',
        'start_time',
        'end_time',
        'duration_days',
        'participants',
        'type',
        'division',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
