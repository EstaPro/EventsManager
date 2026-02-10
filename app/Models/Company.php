<?php

namespace App\Models;

use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;

class Company extends Model
{
    use AsSource, Attachable, Favoritable, Filterable;

    protected $fillable = [
        'name', 'logo', 'booth_number', 'map_coordinates',
        'country', 'category', 'email', 'website_url',
        'phone', 'address', 'description',
        'is_featured', 'is_active'
    ];

    protected $casts = [
        'map_coordinates' => 'array', // JSON {x:10, y:20}
        'is_featured' => 'boolean'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function team()
    {
        // A Company has many Users (Exhibitors)
        return $this->hasMany(User::class, 'company_id');
    }
}
