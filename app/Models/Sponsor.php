<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;

class Sponsor extends Model
{
    use AsSource, Attachable;

    protected $fillable = ['name', 'logo', 'website', 'category_type'];
}
