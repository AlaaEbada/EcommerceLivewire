<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public function cancelOrder($orderId)
    {
        $order = Order::where('id', $orderId)->first();

        if ($order && $order->delivery_status == 'Processing') {
            $order->delivery_status = 'Canceled';
            $order->save();
            $this->loadOrders();
        }
    }
    public function markAsDelivered($orderId)
    {
        $order = Order::find($orderId);
        if ($order && $order->delivery_status === 'Processing') {
            $order->update(['delivery_status' => 'Delivered']);
            session()->flash('message', 'Order marked as delivered.');
        }
    }

    public function render()
    {
        return view('livewire.admin.orders', [
            'orders' => Order::all(),
        ])->layout('layouts.dashboard');
    }
}
