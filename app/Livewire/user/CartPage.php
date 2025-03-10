<?php

namespace App\Livewire\User;

use App\Events\NewOrderPlaced;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Order;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Stripe;

class CartPage extends Component
{
    protected $listeners = ['cartUpdated' => 'loadCart'];

    public $cartItems;
    public $totalPrice = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
{
    $this->cartItems = Cart::where('user_id', Auth::id())->get();
    $this->totalPrice = $this->cartItems->sum(fn($item) => $item->price * $item->quantity);
}

    
public function removeItem($cartId)
{
    $cartItem = Cart::find($cartId);

    if ($cartItem && $cartItem->user_id == Auth::id()) {
        $cartItem->delete();
        $this->loadCart();
        $this->dispatch('cartUpdated');
        session()->flash('message', 'Product removed from cart successfully.');
    } else {
        session()->flash('error', 'Item not found.');
    }
}
    

    public function increaseQuantity($cartId)
    {
        $cart = Cart::find($cartId);
        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
            $this->loadCart();
        }
    }

    public function decreaseQuantity($cartId)
    {
        $cart = Cart::find($cartId);
        if ($cart && $cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->save();
            $this->loadCart();
        }
    }

    public function cashOrder()
    {
        $user_id = Auth::id();
        $cartItems = Cart::where("user_id", $user_id)->get();

        foreach ($cartItems as $cartItem) {
            $order = Order::create([
                'name' => $cartItem->name,
                'email' => $cartItem->email,
                'user_id' => $cartItem->user_id,
                'product_title' => $cartItem->product_title,
                'price' => $cartItem->price,
                'quantity' => $cartItem->quantity,
                'image' => $cartItem->image,
                'product_id' => $cartItem->product_id,
                'payment_status' => 'Cash On Delivery',
                'delivery_status' => 'Processing',
            ]);

            $admin = Admin::find(1);
            // $admin->notify(new NewOrderNotification($user)); //this is to send to just one admin
            Notification::send($admin, new NewOrderNotification($order)); // this is better for more than one

            NewOrderPlaced::dispatch($order);


            $cartItem->delete();
        }

        $this->loadCart();
        session()->flash('message', 'We have received your order. We will contact you soon.');
    }

    public function stripePayment($stripeToken)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $this->totalPrice * 100,
            "currency" => "usd",
            "source" => $stripeToken,
            "description" => "Thanks for your payment",
        ]);

        $user_id = Auth::id();
        $cartItems = Cart::where("user_id", $user_id)->get();

        foreach ($cartItems as $cartItem) {
            $order = Order::create([
                'user_id' => $cartItem->user_id,
                'product_title' => $cartItem->product_title,
                'price' => $cartItem->price,
                'quantity' => $cartItem->quantity,
                'image' => $cartItem->image,
                'product_id' => $cartItem->product_id,
                'payment_status' => 'Paid',
                'delivery_status' => 'Processing',
            ]);

            $admin = Admin::find(1);
            // $admin->notify(new NewOrderNotification($user)); //this is to send to just one admin
            Notification::send($admin, new NewOrderNotification($order)); // this is better for more than one

            NewOrderPlaced::dispatch($order);

            $cartItem->delete();
        }

        $this->loadCart();
        session()->flash('success', 'Payment successful!');
    }

    public function render()
    {
        return view('livewire.user.cart-page');
    }
}
