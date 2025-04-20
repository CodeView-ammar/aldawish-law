<?php

namespace Tasawk\Models\Blogger;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tasawk\Models\Blogger\Categories;
use Tasawk\Traits\Publishable;
use Spatie\Translatable\HasTranslations;
use Tasawk\Models\Blogger\PostMeta;

class Posts extends Model
{
    use HasFactory;
    use HasTranslations, Publishable,SoftDeletes;


    protected $fillable = [
        'authorId',
        'parentId',
        'title', 
        'metaTitle',
        'slug',
        'summary',
        "image",
        'published',
        'createdAt',
        'updatedAt',
        'publishedAt',
        'content',
    ];

    protected $translatable = [
        'title',
        'metaTitle',
        'slug',
        'summary',
        'content',
    ];
    public function author()
    {
        
        return $this->belongsTo(User::class, 'authorId');
    }

    public function parent()
    {
        return $this->belongsTo(Post::class, 'parentId');
    }

    public function children()
    {
        return $this->hasMany(Post::class, 'parentId');
    }
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'post_category', 'postId', 'categoryId');
    }
    public function meta()
    {
        return $this->hasMany(PostMeta::class, 'postId');
    }
    
}