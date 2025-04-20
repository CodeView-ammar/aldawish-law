<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\PageStatus;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class OurService extends PageContent
{
    use HasFactory;

    protected $table = 'page_contents';

    protected $appends = ['default'];
    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("partners", function ($builder) {
            $builder->where('page_id', PageStatus::OURSERVICE);
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
        $this->addMediaCollection('default')
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_CROP, 360, 260);
                $this->addMediaConversion('card')
                    ->fit(Manipulations::FIT_CROP, 946, 500);
            });
    }
}
