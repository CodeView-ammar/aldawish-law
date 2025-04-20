<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\PageStatus;
use Tasawk\Enum\SectionStatus;

class AboutUs extends PageContent
{
    use HasFactory;
    protected $table = 'page_contents';

    protected $appends = [
        'default'
    ];

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("about_us", function ($builder) {
            $builder->where('page_id', PageStatus::ABOUTUS);
        });
    }


    public function getDefaultAttribute()
    {
        return $this->getFirstMediaUrl('default');
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default');
    }

    public function page()
    {
        return $this->belongsTo(Pages::class, 'page_id', 'id');
    }
}
