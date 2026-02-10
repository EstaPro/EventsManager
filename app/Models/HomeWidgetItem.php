<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;

class HomeWidgetItem extends Model
{
    use AsSource, Attachable;

    protected $fillable = ['home_widget_id', 'image', 'icon', 'title', 'subtitle', 'action_url', 'order'];

    protected $appends = ['image_url'];

    public function widget()
    {
        return $this->belongsTo(HomeWidget::class, 'home_widget_id');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset($this->image);
    }
}
