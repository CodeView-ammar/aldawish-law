<?php

namespace Tasawk\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tasawk\Enum\PageStatus;

class TeamMission extends  PageContent
{
    use HasFactory;
    protected $table = 'page_contents';



    protected static function booted()
    {
        parent::booted();
        static::addGlobalScope("about_us", function ($builder) {
            $builder->where('page_id', PageStatus::TEAMMISSION);
        });
    }


    public function page()
    {
        return $this->belongsTo(Pages::class, 'page_id', 'id');
    }


}
