<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddAdmins extends Component
{
    public $name, $email, $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ];

    public function addAdmin()
    {
        $this->validate();

        Admin::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'User added successfully.');
        $this->reset();
    }

    public function render()
    {

        return view('livewire.admin.add-admins')->layout('layouts.dashboard');
    }
}
