<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Auth;

class AddPost extends Component
{
    use WithFileUploads;

    public $title, $content, $slug, $category_id, $featured_image;

    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'content' => 'required|string|min:10',
        'slug' => 'required|string|unique:posts,slug',
        'category_id' => 'required|exists:post_categories,id',
        'featured_image' => 'required|image|max:2048',
    ];

    public function addPost()
    {
        $this->validate();

        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('posts', 'public');
        }

        // إضافة البوست مع تسجيل user_id
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'user_id' => Auth::guard('admin')->id(),

            'featured_image' => $imagePath,
        ]);

        // إعادة ضبط الحقول
        $this->reset(['title', 'content', 'slug', 'category_id', 'featured_image']);

        // إرسال رسالة نجاح
        session()->flash('message', 'Post Added Successfully');
    }

    public function render()
    {
        return view('livewire.admin.add-post', [
            'categories' => PostCategory::all(),
        ])->layout('layouts.dashboard');
    }
}
