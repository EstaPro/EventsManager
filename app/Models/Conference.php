<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Conference extends Model
{
    use AsSource;

    protected $fillable = [
        'title', 'start_time', 'end_time', 'location', 'description', 'type'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'conference_speaker');
    }

    // Who registered for this talk?
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'conference_registrations', 'conference_id', 'user_id');
    }
}
