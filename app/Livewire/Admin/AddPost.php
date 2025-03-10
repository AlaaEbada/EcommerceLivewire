<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AddPost extends Component
{
    use WithFileUploads;

    public $title, $content, $slug, $category_id, $featured_image;
    public $autoGenerateSlug = true; // Flag to control auto-generation

    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'content' => 'required|string|min:10',
        'slug' => 'required|string|unique:posts,slug',
        'category_id' => 'required|exists:post_categories,id',
        'featured_image' => 'required|image|max:2048',
    ];

    // Automatically generate the slug when the title changes
    public function updatedTitle($value)
    {
        if ($this->autoGenerateSlug) {
            $this->slug = Str::slug($value, '-');
        }
    }

    // Stop auto-generating the slug if the user manually edits it
    public function updatedSlug($value)
    {
        $this->autoGenerateSlug = false;
    }

    public function addPost()
    {
        $this->validate();

        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('posts', 'public');
        }

        // Create the post
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'user_id' => Auth::guard('admin')->id(),
            'featured_image' => $imagePath,
        ]);

        // Reset the form fields
        $this->reset(['title', 'content', 'slug', 'category_id', 'featured_image', 'autoGenerateSlug']);

        // Flash a success message
        session()->flash('message', 'Post Added Successfully');
    }

    public function render()
    {
        return view('livewire.admin.add-post', [
            'categories' => PostCategory::all(),
        ])->layout('layouts.dashboard');
    }
}