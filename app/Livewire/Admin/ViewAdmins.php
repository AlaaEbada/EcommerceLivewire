<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;

class ViewAdmins extends Component
{
    use WithPagination;

    public function deleteAdmin($adminId)
    {
        Admin::findOrFail($adminId)->delete();

        session()->flash('message', 'User Deleted Successfully!');
    }
    public function render()
    {
        return view('livewire.admin.view-admins', [
            'admins' => Admin::paginate(10),
        ])->layout('layouts.dashboard');
    }
}
