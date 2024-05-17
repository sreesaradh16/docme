<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('order.index', [
            'orders' => $this->orderService->getOrders()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create', [
            'order_number' => $this->orderService->getOrderNumber()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor' => 'required',
            'purchase_date' => 'required',
            'inventory_location' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $this->orderService->store($request->all());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('Something went wrong');
        }
        DB::commit();
        return redirect()->route('orders.index')->with('success', 'Order added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('order.view', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('order.edit', [
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'vendor' => 'required',
            'purchase_date' => 'required',
            'inventory_location' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $this->orderService->update($order, $request->all());
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return back()->withInput()->withErrors('Something went wrong');
        }
        DB::commit();
        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $this->orderService->delete($order);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Unable to delete order.');
        }
        DB::commit();
        return redirect()->route('orders.index')->withSuccess('Order deleted successfully');
    }
}
