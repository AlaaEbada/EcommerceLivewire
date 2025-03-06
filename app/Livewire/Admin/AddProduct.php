<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;

    public $title, $description, $price, $quantity, $discount_price, $category_id, $image;

    public function addProduct()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'discount_price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048', // صورة بحد أقصى 2MB
        ]);

        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        Product::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'discount_price' => $this->discount_price,
            'category_id' => $this->category_id,
            'image' => $imagePath,
        ]);

        $this->reset(['title', 'description', 'price', 'quantity', 'discount_price', 'category_id', 'image']);

        session()->flash('message', 'Product Added Successfully!');

        // إعادة تعيين القيم بعد الإضافة
    }

    #[Title('Add Product')]
    public function render()
    {
        return view('livewire.admin.add-product', [
            'categories' => Category::all(), //
        ])->layout('layouts.dashboard'); // استخدام الـ Layout الجديد
    }
}
