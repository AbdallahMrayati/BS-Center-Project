<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class City extends Model implements HasMedia
{
    protected $table = 'cities';
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'lang',
        'slug',
        'h1',
        'description',
        'image_title',
        'image_alt',
        'hidden',
        'meta_keywords',
        'meta_title',
        'meta_description',
        'meta_robots',
        'meta_image_size',
        'meta_type',
        'meta_site_name',
        'meta_site',
        'meta_local',
    ];

    public function timings()
    {
        return $this->hasMany(Timing::class, 'city_id', 'id');
    }

    public function cityCategorySeos()
    {
        return $this->hasMany(CityCategorySeo::class, 'city_id', 'id');
    }

    public function getRouteKeyName()
    {
        $currentLocale = app()->getLocale();

        // Choose the appropriate slug field based on the current language
        $slugField = 'slug_' . $currentLocale;

        return $slugField;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
    }
}
