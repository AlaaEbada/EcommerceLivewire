<?php

namespace App\Livewire\Admin;

use App\Models\PostCategory;
use Livewire\Component;

class AddPostCategory extends Component
{
    public $categoryName;
    public function addCategory()
    {
        $this->validate([
            'categoryName' => 'required|string|min:3|unique:post_categories,category_name',
        ]);

        PostCategory::create([
            'category_name' => $this->categoryName,
        ]);

        $this->reset('categoryName');

        session()->flash('message', 'Category Added Successfully');
    }

    public function deleteCategory($id)
    {
        $category = PostCategory::find($id);

        if ($category) {
            $category->delete();

            session()->flash('message', 'Category Deleted Successfully!');
        }
    }

    public function render()
    {
        return view('livewire.admin.add-post-category', [
            'categories' => PostCategory::all(),
        ])->layout('layouts.dashboard');
    }
}
