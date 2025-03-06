<div>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        @if(session()->has('message'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ session()->get('message') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-center mb-6">Add Category</h2>

        <form wire:submit.prevent="addCategory" method="POST" class="space-y-4">
            @csrf
            <input type="text" wire:model="categoryName" name="category" placeholder="Write Category Name"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Add Category
            </button>
        </form>

        <table class="w-full mt-6 border border-gray-200 rounded-md shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Category Name</th>
                    <th class="py-2 px-4 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->isNotEmpty())

                @foreach ($data as $category)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $category->category_name }}</td>
                    <td class="py-2 px-4">
                        <button wire:click="deleteCategory({{ $category->id }})"
                            onclick="return confirm('Are you sure you want to delete this item?');"
                            class="text-red-600 hover:underline">Delete</button>
                    </td>
                </tr>
                @endforeach

                @else

                <tr>
                    <td colspan="2" class="text-center py-4 text-gray-500">No categories found</td>
                </tr>

                @endif
            </tbody>
        </table>
    </div>
</div>
