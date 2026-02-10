<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class HomeWidget extends Model
{
    use AsSource, Filterable;

    protected $fillable = ['title', 'widget_type', 'data_source', 'order', 'is_active'];

    protected $allowedSorts = ['title', 'widget_type', 'order', 'is_active'];

    public const TYPES = [
        'slider'        => 'Hero Slider (Carousel)',
        'menu_grid'     => 'Navigation Grid (Buttons)',
        'logo_cloud'    => 'Logo Cloud (Sponsors/Partners)',
        'single_banner' => 'Single Banner (Ad/Map)',
        'dynamic_list'  => 'Live Database List (Auto)',
    ];

    public const DATA_SOURCES = [
        'companies' => 'Featured Exhibitors',
        'products'  => 'New Products',
        'speakers'  => 'Keynote Speakers',
    ];

    public function items()
    {
        return $this->hasMany(HomeWidgetItem::class)->orderBy('order');
    }
}
