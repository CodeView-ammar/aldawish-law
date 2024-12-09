<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\PageStatus;

class RelevantCompany extends  PageContent
{
    use HasFactory;
    protected $table = 'page_contents';



    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("about_us", function ($builder) {
            $builder->where('page_id', PageStatus::RELEVANTCOMPANY);
        });
    }


    public function page()
    {
        return $this->belongsTo(Pages::class, 'page_id', 'id');
    }

}
