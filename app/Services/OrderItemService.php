<?php

namespace App\Services;

use App\Models\OrderItem;

class OrderItemService
{
    public function getOrderItems()
    {
        return OrderItem::get();
    }

    public function store($data)
    {
        foreach ($data['product_name'] as $key => $product_name) {
            OrderItem::create([
                'order_id' => $data['order_id'],
                'product_name' => $product_name,
                'quantity' => $data['quantity'][$key],
                'amount' => $data['amount'][$key],
                'discount' => $data['discount'][$key],
                'tax' => $data['tax'][$key],
                'total' => $data['total'][$key],
            ]);
        }
    }

    public function deleteAll($order_items)
    {
        foreach ($order_items as $order_item) {
            $order_item->delete();
        }
    }
}
