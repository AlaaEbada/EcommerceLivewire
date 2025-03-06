<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ViewPosts extends Component
{

    use WithPagination;

    public function deletePost($id)
    {
        $product = Post::find($id);

        if ($product) {
            $product->delete();

        session()->flash('message', 'Product Deleted Successfully!');
        }
    }

    #[Title('Posts')]
    public function render()
    {
        return view('livewire.admin.view-posts',[
            'posts' => Post::latest()->paginate(10), // عرض المنتجات الأخيرة بالصفحة
            ])->layout('layouts.dashboard'); // استخدام الـ Layout الجديد
    }

}
