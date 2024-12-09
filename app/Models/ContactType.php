<?php

namespace Tasawk\Models;

use Tasawk\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Tasawk\Models\Content\Contact;

class ContactType extends Model {
    use HasFactory, Publishable,HasTranslations;
    protected $translatable= ['name'];
    protected $fillable = ['name','status'];

    public function contacts() {
        return $this->hasMany(Contact::class);
    }
}
