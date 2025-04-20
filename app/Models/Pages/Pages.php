<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\PageStatus;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Tasawk\Traits\Publishable;


class Pages extends Model 
{

    protected $table = 'pages_site';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pageContent()
    {
        return $this->hasMany(PageContent::class, 'page_id', 'id');
    }
}
