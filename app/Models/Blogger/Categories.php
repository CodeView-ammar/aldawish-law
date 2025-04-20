<?php

namespace Tasawk\Models\Blogger;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tasawk\Models\Blogger\Posts;
use Spatie\Translatable\HasTranslations;
use Tasawk\Traits\Publishable;

class Categories extends Model
{
    use HasFactory;

    use HasTranslations, Publishable,SoftDeletes;
    protected $fillable = [
        'title',
        'metaTitle',
        'slug',
        'content',
        'parentId',
    ];

    protected $translatable = [
        'title',
        'metaTitle',
        'slug',
        'content',
    ];
    public function parent()
    {
        return $this->belongsTo(Categories::class, 'parentId');
    }

    public function children()
    {
        return $this->hasMany(Categories::class, 'parentId');
    }
    public function posts()
    {
        return $this->belongsToMany(Posts::class, 'post_category', 'categoryId', 'postId');
    }
}