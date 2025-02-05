<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'token',
        'school',
        'is_presence',
        'presence_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
