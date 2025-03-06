<div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-center mb-6">View Users</h2>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 shadow-md rounded-lg">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <div class="flex gap-2">
                                <a wire:navigate href="{{ route('admin.edit.user', $user->id) }}"
                                   class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                    Edit
                                </a>

                                <button wire:click="deleteUser({{ $user->id }})"
                                        onclick="return confirm('Are you sure you want to delete this user?');"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
