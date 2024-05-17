<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    protected $orderItemService;

    public function __construct()
    {
        $this->orderItemService = new OrderItemService();
    }

    public function getOrderNumber()
    {
        $order = Order::first();

        if ($order) {
            return 'PO_00' . $order->id + 1;
        } else {
            return 'PO_001';
        }
    }

    public function getOrders()
    {
        return Order::get();
    }

    public function store($data)
    {
        $order =  Order::create([
            'vendor' => $data['vendor'],
            'order_number' => $data['order_number'],
            'purchase_date' => $data['purchase_date'],
            'inventory_location' => $data['inventory_location']
        ]);

        $order_data = [
            'order_id' => $order->id,
            'product_name' => $data['product'],
            'quantity' => $data['quantity'],
            'amount' => $data['amount'],
            'discount' => $data['discount'],
            'tax' => $data['tax'],
            'total' => $data['total'],
        ];
        $this->orderItemService->store($order_data);
        return $order;
    }

    public function update($order, $data)
    {
        $order->vendor = $data['vendor'];
        $order->order_number = $data['order_number'];
        $order->purchase_date = $data['purchase_date'];
        $order->inventory_location = $data['inventory_location'];
        $order->save();

        $this->orderItemService->deleteAll($order->order_items);

        $order_data = [
            'order_id' => $order->id,
            'product_name' => $data['product'],
            'quantity' => $data['quantity'],
            'amount' => $data['amount'],
            'discount' => $data['discount'],
            'tax' => $data['tax'],
            'total' => $data['total'],
        ];
        $this->orderItemService->store($order_data);

        return $order;
    }

    public function delete($order)
    {
        $order->delete();
    }
}
