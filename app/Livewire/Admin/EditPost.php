<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditPost extends Component
{
    use WithFileUploads;

    public $post;
    public $title, $content, $slug, $category_id, $featured_image, $image;

    public function mount($postId)
    {
        $this->post = Post::findOrFail($postId);
        $this->title = $this->post->title;
        $this->content = $this->post->content;
        $this->slug = $this->post->slug;
        $this->category_id = $this->post->category_id;
        $this->image = $this->post->featured_image;

    }

    public function updatePost()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'slug' => 'required|string|unique:posts,slug,' . $this->post->id,
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|max:2048',
        ]);


        if ($this->featured_image) {
            // Delete old image if a new one is uploaded
            if ($this->image) {
                Storage::delete('public/' . $this->image);
            }

            // Upload new image
            $imagePath = $this->featured_image->store('posts', 'public');
        } else {
            // Keep the old image if no new one is uploaded
            $imagePath = $this->image;
        }


        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
            'slug' => Str::slug($this->slug),
            'category_id' => $this->category_id,
            'featured_image' => $imagePath,

        ]);

        session()->flash('message', 'Post updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.edit-post', [
            'categories' => PostCategory::all(),
        ])->layout('layouts.dashboard');
    }
}
