<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    protected $table = 'blogs';
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'lang',
        'description',
        'image_alt',
        'image_title',
        'slug',
        'tag_name',
        'number_of_views',
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
        'hidden',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
    }
}
