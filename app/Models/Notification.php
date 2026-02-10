<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Notification extends Model
{
    use AsSource;

    // ⚠️ IMPORTANT: Point to the custom table
    protected $table = 'app_notifications';

    protected $fillable = [
        'user_id', 'title', 'body', 'type', 'data', 'is_read'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean'
    ];
}
