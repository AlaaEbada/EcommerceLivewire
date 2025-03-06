<div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-center mb-6">Edit User</h2>

    <form wire:submit.prevent="updateUser">
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" wire:model="name"
                   class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" wire:model="email"
                   class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
            Update User
        </button>
    </form>
</div>
