<div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-center mb-6">Add Admin</h2>

    <form wire:submit.prevent="addAdmin">
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" wire:model="name"
                   class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" wire:model="email"
                   class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Password</label>
            <input type="password" wire:model="password"
                   class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
            Add User
        </button>
    </form>
</div>
