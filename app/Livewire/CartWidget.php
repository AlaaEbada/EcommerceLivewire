<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartWidget extends Component
{
    public function removeItem($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->delete();
            $this->dispatch('cartUpdated');

        }
    }

    public function render()
    {
        return view('livewire.cart-widget', [
            'cartItems' => Cart::where('user_id', auth()->id())->get(),
        ]);
    }
}
