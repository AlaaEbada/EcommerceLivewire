<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class SingleProduct extends Component
{
    public $product;
    public $productId;
    public $quantity = [];


    public function mount($productId)
    {
        $this->product = Product::findOrFail($productId);
    }

    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect('login')    ;
        }

        $user = Auth::user();
        $product = Product::findOrFail($productId);
        $selectedQuantity = $this->quantity[$productId] ?? 1;

        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $selectedQuantity;
            $cartItem->price = ($product->discount_price ?? $product->price) * $cartItem->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'user_id' => $user->id,
                'product_title' => $product->title,
                'price' => ($product->discount_price ?? $product->price) * $selectedQuantity,
                'image' => $product->image,
                'product_id' => $product->id,
                'quantity' => $selectedQuantity,
            ]);
        }

        $this->dispatch('cartUpdated'); // Notify other components (like a cart icon)

        $this->dispatch('alert', type: 'success', title: __('Product added successfully'));
    }

    public function render()
    {
        return view('livewire.user.single-product');
    }
}
