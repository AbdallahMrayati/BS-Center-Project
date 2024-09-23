<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Meta extends Model implements HasMedia
{
    protected $table = 'metas';

    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'section',
        'meta_keywords_ar',
        'meta_keywords_en',
        'meta_title_ar',
        'meta_title_en',
        'meta_description_ar',
        'meta_description_en',
        'meta_robots_ar',
        'meta_robots_en',
        'meta_image_size',
        'meta_type_ar',
        'meta_type_en',
        'meta_site_name_ar',
        'meta_site_name_en',
        'meta_site_ar',
        'meta_site_en',
        'meta_local_ar',
        'meta_local_en',
        'meta_card_ar',
        'meta_card_en',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
    }
}
