<?php

namespace Tasawk\Models\Content;

use Tasawk\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Banner extends Model implements HasMedia
{
    use Publishable;
    use HasFactory, InteractsWithMedia, HasTranslations;
    protected $fillable = [
        'title',
        'description',
        'link',
        'status',
    ];

    protected $appends = [
        'image_ar',
        'image_en',
        'image_fr',
        'image_zh',
        'image_de'
    ];

    protected $translatable = [
        'title',
        'description',
    ];
    protected $casts = [
        'title' => 'json',
        'description' => 'json',
    ];

    public function getImageEnAttribute()
    {
        return $this->getFirstMediaUrl('image_en');
    }

    public function getImageArAttribute()
    {
        return $this->getFirstMediaUrl('image_ar');
    }
    public function getImageFrAttribute()
    {
        return $this->getFirstMediaUrl('image_fr');
    }

    public function getImageZhAttribute()
    {
        return $this->getFirstMediaUrl('image_zh');
    }

    public function getImageDeAttribute()
    {
        return $this->getFirstMediaUrl('image_de');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image_ar');
        $this->addMediaCollection('image_en');
        $this->addMediaCollection('image_fr');
        $this->addMediaCollection('image_zh');
        $this->addMediaCollection('image_de');

    }
}
