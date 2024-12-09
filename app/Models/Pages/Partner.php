<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\PageStatus;


class Partner extends PageContent
{
    use HasFactory;
    protected $table = 'page_contents';

    protected $appends = ['default'];
    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("partners", function ($builder) {
            $builder->where('page_id', PageStatus::PARTNER);
        });
    }

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