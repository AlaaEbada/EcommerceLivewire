    <div>
        <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-center mb-6">Edit Product</h2>

            @if (session()->has('message'))
                <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="updateProduct">
                <div class="mb-4">
                    <label class="block font-semibold">Title</label>
                    <input type="text" wire:model="title" class="w-full border-gray-300 rounded-lg p-2">
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Description</label>
                    <textarea wire:model="description" class="w-full border-gray-300 rounded-lg p-2"></textarea>
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="w-1/2">
                        <label class="block font-semibold">Price</label>
                        <input type="number" wire:model="price" class="w-full border-gray-300 rounded-lg p-2">
                        @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-1/2">
                        <label class="block font-semibold">Discount Price</label>
                        <input type="number" wire:model="discount_price" class="w-full border-gray-300 rounded-lg p-2">
                        @error('discount_price') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Category</label>
                    <select wire:model="category_id" class="w-full border-gray-300 rounded-lg p-2">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Product Image</label>
                    <input type="file" wire:model="newImage" class="w-full border-gray-300 rounded-lg p-2">

                    <div wire:loading wire:target="newImage" class="text-blue-500 text-sm mt-2">
                        Uploading image...
                    </div>

                    @if ($newImage)
                        <img src="{{ $newImage->temporaryUrl() }}" class="w-24 h-24 mt-2 object-cover rounded-md">
                    @else
                        <img src="{{ asset('storage/' . $image) }}" class="w-24 h-24 mt-2 object-cover rounded-md">
                    @endif

                    @error('newImage') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">


                        <span wire:loading.remove wire:target="updateProduct">Update</span>
                        <svg wire:loading wire:target="updateProduct"
                            class="animate-spin h-6 w-6 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            ></path>
                        </svg>
                    </button>
                    <a wire:navigate href="{{ url('/admin/view_product') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
