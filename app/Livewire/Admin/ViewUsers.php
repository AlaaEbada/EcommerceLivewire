<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class ViewUsers extends Component
{
    use WithPagination;

    public function deleteUser($userId)
    {
        User::findOrFail($userId)->delete();

        session()->flash('message', 'User Deleted Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.view-users', [
            'users' => User::paginate(10),
        ])->layout('layouts.dashboard');
    }
}
