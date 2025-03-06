<div>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ session()->get('message') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-center mb-6">Show Posts</h2>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 shadow-md rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">Content</th>
                        <th class="py-3 px-4 text-left">Slug</th>
                        <th class="py-3 px-4 text-left">Author</th>
                        <th class="py-3 px-4 text-left">Category</th>
                        <th class="py-3 px-4 text-left">Featured Image</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $post->title }}</td>
                            <td class="py-3 px-4">{{ Str::limit($post->content, 50) }}</td>
                            <td class="py-3 px-4">{{ $post->slug }}</td>
                            <td class="py-3 px-4">{{ optional($post->user)->name }}</td>
                            <td class="py-3 px-4">{{ optional($post->category)->category_name }}</td>
                            <td class="py-3 px-4">
                                @if ($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                                        alt="{{ $post->title }}"
                                        class="w-24 h-24 object-cover rounded-md">
                                @else
                                    <span class="text-gray-500">No Image</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex gap-2">
                                    <a wire:navigate href="{{ route('admin.edit.post', $post->id) }}"
                                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                        Edit
                                    </a>
                                    <button wire:click="deletePost({{ $post->id }})"
                                        onclick="return confirm('Are you sure you want to delete this post?');"
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
</div>
