<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Appointment extends Model
{
    use AsSource, Filterable;

    protected $fillable = [
        'booker_id', 'target_user_id',
        'scheduled_at', 'duration_minutes', 'table_location',
        'status', 'notes', 'rating', 'feedback'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // ✅ ADDED: Allowed fields for sorting
    protected $allowedSorts = [
        'id',
        'status',
        'scheduled_at',
        'created_at',
        'table_location',
        // These are handled manually in the Screen, but good to list
        'booker.name',
        'targetUser.name',
    ];

    // ✅ ADDED: Allowed fields for filtering
    protected $allowedFilters = [
        'id',
        'status',
        'scheduled_at',
        'table_location',
        'created_at',
        // Note: Relationship filters (booker.name) are handled in the Screen query manually
    ];

    public function booker()
    {
        return $this->belongsTo(User::class, 'booker_id');
    }

    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
