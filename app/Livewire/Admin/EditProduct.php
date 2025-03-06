<?php
namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;
    public $productId, $title, $description, $price, $discount_price, $quantity, $category_id, $image, $newImage;
    public $categories;

    public function mount($productId)
    {
        $product = Product::findOrFail($productId);
        $this->productId = $product->id;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->discount_price = $product->discount_price;
        $this->category_id = $product->category_id;
        $this->image = $product->image;
        $this->categories = Category::all();
    }
    public function updateProduct()
{
    // Validate the input fields
    $this->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'newImage' => 'nullable|image|max:1024', // Adjust validation for image uploads
    ]);

    // Find the product to update
    $product = Product::findOrFail($this->productId);

    // Handle image upload
    if ($this->newImage) {

        $imagePath = $this->newImage->store('products', 'public');
    } else {
        // Keep the old image if no new image is uploaded
        $imagePath = $product->image;
    }

    // Update the product details
    $product->update([
        'title' => $this->title,
        'description' => $this->description,
        'price' => $this->price,
        'discount_price' => $this->discount_price,
        'category_id' => $this->category_id,
        'image' => $imagePath,
    ]);

    // Show a success message
    session()->flash('message', 'Product updated successfully!');
}

    public function render()
    {
        return view('livewire.admin.edit-product')->layout('layouts.dashboard'); // استخدام الـ Layout الجديد;
    }
}
