<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;

    #[Url()]
    public $search;
    public $selectedCategory = null; // Property to hold the selected category

    // Get posts based on search and category
    #[Computed()]
    public function posts()
    {
        $query = Post::query();

        // Apply category filter
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        // Apply search filter
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        return $query->paginate(6);
    }

    #[Computed()]
    public function categories()
    {
        return PostCategory::all();
    }

    // Reset pagination when search term changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Filter posts by category
    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function removeCategoryFilter()
    {
        $this->selectedCategory = null;
        $this->resetPage();
    }


    #[Title('Blog')]
    public function render()
    {
        return view('livewire.user.blog');
    }
}
