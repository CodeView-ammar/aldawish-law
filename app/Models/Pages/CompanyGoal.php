<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\PageStatus;

class CompanyGoal extends PageContent
{
    use HasFactory;
    protected $table = 'page_contents';

    protected $appends = [
        'image_ar',
        'image_en',
    ];

    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("about_us", function ($builder) {
            $builder->where('page_id', PageStatus::COMPANYGOALS);
        });
    }


    public function getImageEnAttribute()
    {
        return $this->getFirstMediaUrl('image_en');
    }

    public function getImageArAttribute()
    {
        return $this->getFirstMediaUrl('image_ar');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image_ar');
        $this->addMediaCollection('image_en');
    }

    public function page()
    {
        return $this->belongsTo(Pages::class, 'page_id', 'id');
    }
}
