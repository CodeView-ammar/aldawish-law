<?php

namespace Tasawk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Tasawk\Traits\Publishable;
use Illuminate\Database\Eloquent\SoftDeletes;


class CaseType extends Model
{
    use HasFactory;
    use HasTranslations, Publishable,SoftDeletes;
    protected $fillable = [
        'name',
        'status',
    ];

    protected $translatable = [
        'name',
    ];

    public function orders(){
        return $this->hasMany(Order::class,'case_type');
    }

}
