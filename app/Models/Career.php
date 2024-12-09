<?php

namespace Tasawk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Tasawk\Traits\Publishable;

class Career extends Model implements HasMedia
{
    use  Publishable, InteractsWithMedia;

    protected $table = 'careers';

    protected $appends = ['cv'];

    protected $fillable = [
        'name',
        'gender',
        'age',
        'address',
        'phone',
        'email',
        'job_title',
        'position',
        'data',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function getCVAttribute()
    {
        return $this->getFirstMediaUrl('cv');
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cv');
    }

    public function getGenderTextAttribute()
    {
        return $this->gender == 'male' ? __('forms.fields.male') : __('forms.fields.female');
    }
}
