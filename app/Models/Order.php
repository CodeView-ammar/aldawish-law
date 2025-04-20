<?php

namespace Tasawk\Models;

use Cknow\Money\Casts\MoneyDecimalCast;
use Darryldecode\Cart\CartCondition;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Tasawk\Enum\OrderPaymentStatus;
use Tasawk\Enum\OrderStatus;
use Tasawk\Lib\ArrayStorage;
use Tasawk\Lib\Cart as CoreCart;
use Tasawk\Models\Order\Condition;
use Tasawk\Models\Order\ItemsLine;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Tasawk\Traits\Transactionable;
use Tasawk\Traits\Publishable;

class Order extends Model implements HasMedia
{
    use  Publishable, InteractsWithMedia;
    use AgoraSession;
    protected $appends = ['file'];
    protected $fillable = [
        'customer_id',
        'ristrict',
        // 'id_number',
        'client_name',
        'phone_number',
        'email',
        'address',
        'case_type',
        'case_status',
        'court',
        'party_in_the_case',
        'case_number' ,
        'case_summary',
        'date',
        'service_data',
        'payment_status',
        'payment_data',
        'status',
        'total',
        'notes',
        'qota',
        "order_number",
        'payment_type',
        'duration',
        'comment',
        'account_number',
        'iban_number',
        'meeting_link',
        "responsible_user_id",

    ];
    protected $casts = [
        'date' => 'datetime',
        'service_data' => 'json',
        'payment_data' => 'array',
        'payment_status' => OrderPaymentStatus::class,
        'qota' => 'array',
        'status' => OrderStatus::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // public function getStatusAttribute($value)
    // {
    //     if ($value != "cancelled") {
    //         if (Carbon::parse($this->date)->addHours(24)->format('Y-m-d H:i') < Carbon::now()->format('Y-m-d H:i')) {
    //             return OrderStatus::EXPIRED;
    //         } elseif ((Carbon::parse($this->date)->format('Y-m-d H:i') >= Carbon::now()->format('Y-m-d'))) {
    //             return OrderStatus::PENDING;
    //         } else {
    //             return $value;
    //         }
    //     } else {
    //         return OrderStatus::CANCELLED;
    //     }
    // }

    public function scopePaid($builder)
    {
        return $builder->where(['payment_status' => OrderPaymentStatus::PAID])->where('payment_data','!=',null)->where('payment_type','!=','bank_transfer_receipt');
    }

    public function caseType()
    {
        return $this->belongsTo(CaseType::class, 'case_type');
    }

    public function caseParty()
    {
        return $this->belongsTo(CaseParty::class, 'party_in_the_case');
    }
    public function getOrderNumberAttribute(): string
    {
        return sprintf("%'.06d", $this->id);
    }
    public function getStatusTextAttribute()
    {
        return __("forms.fields.$this->status");
    }

    function itemsLine(): HasMany
    {
        return $this->hasMany(ItemsLine::class);
    }
    function conditions(): HasMany
    {
        return $this->hasMany(Condition::class);
    }

    public function responsibleUser()
    {
        return $this->belongsTo(User::class, 'responsible_user_id')
            ->whereHas('roles', function ($query) {
                $query->whereNotIn('name', ['customer', 'manager', 'operator', 'panel_user', 'super_admin']);
            });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function cancellation(): HasOne
    {
        return $this->hasOne(OrderCancellation::class, "order_id");
    }
    public function userInformation()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getTotalTextAttribute()
    {
        if ($this->total > 0) {
            return $this->total . " " . __("forms.suffixes.sar");
        } else {
            return __("menu.total_not_specified");
        }
    }

    public function getPriceTextAttribute()
    {
        if ($this->total > 0) {
            return ($this->total) . " " . __("forms.suffixes.sar");
        } else {
            return __("menu.total_not_specified");
        }
    }
    

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function getRistrictNameAttribute()
    {
        return __("forms.fields.$this->ristrict");
    }



    public function getCaseStatusNameAttribute()
    {
        return __("forms.fields.$this->case_status");
    }
    public function getPaymentTypeTextAttribute()
    {
        if($this->payment_type == null){
            return  __("menu.payment_not_determird");

        }
        if($this->payment_type == 'bank_transfer_receipt'){
            return __("forms.fields.$this->payment_type");

        }
        return $this->payment_type;
    }

    public function getFileAttribute()
    {
        return $this->getMedia('consultation');
    }
    public function getAttachmentAttribute()
    {
        return $this->getFirstMediaUrl('attachment');
    }



    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('consultation');
        $this->addMediaCollection('attachment');
    }

    public function getDateTextAttribute()
    {
        return $this->date == null ?  __("menu.The session date has not been determined") : $this->date->format('Y-m-d H:i');
    }

    public function getDurationTextAttribute()
    {
        if ($this->duration == '15') {
            return __("menu.15m");
        } elseif ($this->duration == '30') {
            return __("menu.30m");
        } elseif ($this->duration == '45') {
            return __("menu.45m");
        } elseif ($this->duration == '60') {
            return __("menu.60m");
        }
    }
}
