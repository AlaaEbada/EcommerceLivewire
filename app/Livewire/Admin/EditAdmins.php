<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditAdmins extends Component
{

    public $userId, $name, $email, $password;

    public function mount($adminId)
    {
        $admin = Admin::findOrFail($adminId);
        $this->userId = $admin->id;
        $this->name = $admin->name;
        $this->email = $admin->email;
    }

    public function updateAdmin()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6'
        ]);

        $admin = Admin::findOrFail($this->userId);
        $admin->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $admin->password,
        ]);

        session()->flash('message', 'User updated successfully.');
    }
    public function render()
    {
        return view('livewire.admin.edit-admins')->layout('layouts.dashboard');

    }
}
