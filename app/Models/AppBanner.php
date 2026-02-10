<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Types\Like;

class AppBanner extends Model
{
    use AsSource, Filterable, Attachable;

    protected $fillable = [
        'home_section_id', // Foreign Key
        'image_path',
        'title',
        'link_url',
        'order',
        'is_active'
    ];

    protected $allowedSorts = ['order', 'home_section_id', 'is_active'];
    protected $allowedFilters = [
        'title' => Like::class
    ];

    protected $appends = ['image_url'];

    public function section()
    {
        return $this->belongsTo(HomeSection::class, 'home_section_id');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) return null;
        if (str_starts_with($this->image_path, 'http')) return $this->image_path;
        return asset($this->image_path);
    }
}
