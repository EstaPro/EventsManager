<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;

class Product extends Model
{
    use AsSource, Attachable;

    protected $fillable = [
        'company_id',
        'category_id',
        'name',
        'image',
        'type',
        'description',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean'
    ];

    protected $appends = ['image_url'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // If it's already a full URL (e.g. from S3), return it
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Otherwise, generate the full public URL
        return asset($this->image);
    }
}
