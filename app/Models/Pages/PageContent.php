<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Tasawk\Enum\PageStatus;
use Tasawk\Traits\Publishable;

class PageContent extends Model implements HasMedia
{
    use HasTranslations, Publishable, InteractsWithMedia;

    protected $table = 'page_contents';

    protected $appends = [
        'default'
    ];

    protected $fillable = [
        'id',
        'page_id',
        'title',
        'description',
        'meta_data',
        'section',
        'group',
        'status',
        'sort',
        'created_at',
        'updated_at',
        'link',
        'icon',
    ];

    protected $casts = [
        'id' => 'string',
        'page_id' => PageStatus::class,
        'title' => 'array',
        'description' => 'array',
        'meta_data' => 'json',
        'section' => 'string',
        'group' => 'string',
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'date',
    ];

    protected $translatable = [
        'title',
        'description',
        'meta_data',
    ];



    public function page()
    {
        return $this->belongsTo(Pages::class, 'page_id', 'id');
    }

    public function getDefaultAttribute()
    {
        return $this->getFirstMediaUrl('default');
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default');
    }



}
