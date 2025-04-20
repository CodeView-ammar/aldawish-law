<?php

namespace Tasawk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectornicReport extends  Order
{
    use HasFactory;
    protected $table = 'orders';

    public function getMorphClass(): string
    {
        return Order::class;
    }
    protected static function booted() {
        parent::booted();
        static::addGlobalScope("paid", function ($builder) {
            $builder->where('payment_status', 'paid');  
        });
    }
    
}