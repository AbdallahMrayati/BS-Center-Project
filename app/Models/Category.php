<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'lang',
        'description',
        'image_alt',
        'image_title',
        'slug',
        'meta_keywords',
        'meta_title',
        'meta_description',
        'meta_robots',
        'meta_image_size',
        'meta_type',
        'meta_site_name',
        'meta_site',
        'meta_local',
        'meta_card',
        'h1',
        'hidden'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }

    public function cityCategorySeos()
    {
        return $this->hasMany(CityCategorySeo::class, 'category_id', 'id');
    }

    public function requestsOnline()
    {
        return $this->hasMany(RequestOnline::class, 'category_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
        $this->addMediaCollection('multi_images'); // Collection for multiple images
    }

}
