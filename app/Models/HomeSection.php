<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;

class HomeSection extends Model
{
    use AsSource, Filterable;

    protected $fillable = [
        'section_key',
        'title',
        'background_image',
        'background_color',
        'order',
        'is_active'
    ];

    protected $allowedSorts = ['order', 'section_key', 'is_active'];
    protected $allowedFilters = [
        'title' => Like::class,
        'section_key' => Like::class
    ];

    // Relationship: One Section has Many Banners
    public function banners()
    {
        return $this->hasMany(AppBanner::class)->orderBy('order');
    }
}
