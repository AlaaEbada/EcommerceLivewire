<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartWidget extends Component
{
    public $cartItems = [];

    protected $listeners = ['cartUpdated' => 'fetchCart'];

    public function mount()
    {
        $this->fetchCart();
    }

    public function fetchCart()
    {
        $this->cartItems = Cart::where('user_id', auth()->id())->get();
    }

    public function removeItem($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->delete();
            $this->fetchCart();
            $this->dispatch('cartUpdated')->to(self::class); // يرسل التحديث فقط للمكون الحالي
        }
    }

    public function render()
    {
        return view('livewire.cart-widget');
    }
}
