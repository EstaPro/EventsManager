<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;

class Event extends Model
{
    use AsSource, Attachable, Filterable;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'is_active',
        'floor_plan_image' // Virtual attribute for attachment handling
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date'   => 'datetime',
            'is_active'  => 'boolean',
        ];
    }


    // Relationships
    public function conferences() {
        return $this->hasMany(Conference::class);
    }

    public function companies() {
        return $this->belongsToMany(Company::class, 'event_company')
            ->withPivot('booth_number', 'map_coordinates');
    }

    public function organizers() {
        return $this->belongsToMany(Organizer::class, 'event_organizer');
    }

    public function sponsors() {
        return $this->belongsToMany(Sponsor::class, 'event_sponsor');
    }
}
