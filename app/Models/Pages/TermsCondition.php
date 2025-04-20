<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\PageStatus;

class TermsCondition extends PageContent
{
    use HasFactory;
    protected $table = 'page_contents';

    protected $fillable = [
        'id',
        'page_id',
        'title',
        'description',
        'meta_data',
        'section',
        'group',
        'status',
        'created_at',
        'updated_at',
    ];
    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("about_us", function ($builder) {
            $builder->where('page_id', PageStatus::TERMSCONDITION);
        });
    }

    public function page()
    {
        return $this->belongsTo(Pages::class, 'page_id', 'id');
    }

}
