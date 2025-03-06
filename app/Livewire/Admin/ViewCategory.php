<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\Component;

class ViewCategory extends Component
{

    public $categoryName;
    public function addCategory()
    {
        $this->validate([
            'categoryName' => 'required|string|min:3|unique:categories,category_name',
        ]);

        Category::create([
            'category_name' => $this->categoryName,
        ]);

        $this->reset('categoryName');

        session()->flash('message', 'Category Added Successfully');
    }

    public function deleteCategory($id)
{
    $category = Category::find($id);

    if ($category) {
        $category->delete();

        session()->flash('message', 'Category Deleted Successfully!');
    }
}



    public function render()
    {
        return view('livewire.admin.view-category' , [
            'data' => Category::all(),
        ])->layout('layouts.dashboard'); // استخدام الـ Layout الجديد
    }
}
