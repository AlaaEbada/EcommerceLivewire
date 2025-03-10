<?php

namespace App\Livewire\User;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
        use WithPagination;

        public $search = '';

        protected $queryString = ['search'];

        public $perPage = 12;
        public $quantity = [];
        public $categories;
        public $cartCount = 0;

    public function mount()
    {
        $this->categories = Category::with('products')->get();
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        if (Auth::check()) {
            $this->cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
        }
    }

    public function addToCart($productId)
    {
        if (Auth::check()) {
            
        $user = Auth::user();
        $product = Product::findOrFail($productId);
        $selectedQuantity = $this->quantity[$productId] ?? 1; // Default to 1 if not set

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

        $this->updateCartCount();

        $this->dispatch('cartUpdated'); // Notify other components (like a cart icon)

        $this->dispatch('alert', type: 'success', title: __('Product added successfully'));

        } else{
            return redirect()->route('login');
        }

    }

        public function render()
        {
            $products = Product::query()
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                })
                ->paginate(12);

            return view('livewire.user.shop', [
                'products' => $products,
            ]);
        }
}
