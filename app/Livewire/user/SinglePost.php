<?php

namespace App\Livewire\User;

use App\Models\Post;
use Livewire\Component;

class SinglePost extends Component
{
    public $post;

    public $relatedPosts;
    public function mount($slug)
    {
        // Fetch the post using the slug
        $this->post = Post::where('slug', $slug)->firstOrFail();

        $this->relatedPosts = Post::where('category_id', $this->post->category_id)
        ->where('id', '!=', $this->post->id)
        ->latest()
        ->take(3)
        ->get();
    }

    public function render()
    {
        return view('livewire.user.single-post');
    }
}
