<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchProducts extends Component
{
    public $query = '';
    public $products = [];

    public function updatedQuery()
    {
        if (strlen($this->query) > 1) { // Prevent empty search
            $this->products = Product::where('title', 'like', '%' . $this->query . '%')
                ->take(5)
                ->get();

            // Debugging
            logger($this->products);
        } else {
            $this->products = [];
        }
    }

    public function render()
    {
        return view('livewire.search-products');
    }
}
