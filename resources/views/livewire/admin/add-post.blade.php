<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Add New Post</h2>

    <form wire:submit.prevent="addPost">
        <!-- Title -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Post Title:</label>
            <input type="text" wire:model="title" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Content -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Content:</label>
            <textarea wire:model="content" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400"></textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Category -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Category:</label>
            <select wire:model="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400">
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Featured Image -->
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Featured Image:</label>
            <input type="file" wire:model="featured_image" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400">
            @error('featured_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div wire:loading wire:target="featured_image" class="text-blue-500 text-sm mt-2">
                Uploading image...
            </div>

            @if ($featured_image)
                <div class="mt-4">
                    <p class="text-gray-700 font-bold mb-2">Image Preview:</p>
                    <img src="{{ $featured_image->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300"
                wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="addPost">Add Post</span>
                <svg wire:loading wire:target="addPost" class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>
        </div>
    </form>
</div>