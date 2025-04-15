<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasUuids, HasFactory;

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

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
