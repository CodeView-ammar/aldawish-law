<?php

namespace Tasawk\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tasawk\Models\User;
use Tasawk\Models\ContactType;

class Contact extends Model {


    protected $fillable = [

        "message",
        "user_id",
        "name",
        "email",
        "phone",
        "seen",
        'contact_type_id'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class,);
    }

    public function contactType(): BelongsTo {
        return $this->belongsTo(ContactType::class);
    }


}
