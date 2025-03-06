<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ViewProduct extends Component
{
    use WithPagination; // استخدام الرفع الخاص بـ Livewire



    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();

            // إرسال رسالة نجاح للمستخدم
            session()->flash('message', 'Product Deleted Successfully!');
        }
    }

    #[Title('Products')]
    public function render()
    {
        return view('livewire.admin.view-product',[
            'products' => Product::latest()->paginate(10), // عرض المنتجات الأخيرة بالصفحة
            ])->layout('layouts.dashboard'); // استخدام الـ Layout الجديد
        }
    }
