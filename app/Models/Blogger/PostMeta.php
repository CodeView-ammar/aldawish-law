<?php

namespace Tasawk\Models\Blogger;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Models\Blogger\Posts;

class PostMeta extends Model
{
    use HasFactory;

    protected $table = 'post_meta'; // تحديد اسم الجدول

    protected $fillable = [
        'postId',
        'key',
        'content',
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'postId');
    }
}
