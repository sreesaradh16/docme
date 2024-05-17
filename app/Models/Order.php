<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor',
        'order_number',
        'purchase_date',
        'inventory_location'
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
