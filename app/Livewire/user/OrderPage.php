<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderPage extends Component
{
    public $orders;

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = Order::where('user_id', Auth::id())->latest()->get();
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->first();

        if ($order && $order->delivery_status == 'Processing') {
            $order->delivery_status = 'Canceled';
            $order->save();
            $this->loadOrders();
        }
    }


    public function render()
    {
        return view('livewire.user.order-page', [
            'orders' => $this->orders,
        ]);
    }
}
