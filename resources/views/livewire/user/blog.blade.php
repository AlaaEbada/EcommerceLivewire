<div wire:poll>
    <style>
        /* Add this to your custom styles */
        button i {
            transition: transform 0.2s ease-in-out;
        }

        button:hover i {
            transform: scale(1.2);
        }
    </style>

    <!-- Blog Page Hero Section -->
    <x-hero-section title="{{ __('Blog') }}"
        subtitle="{{ __('Explore our latest insights, stories, and industry news. Stay up-to-date with our thoughts and expertise.') }}" />

    <section id="blog" class="py-20 px-6 bg-gray-50">
        <div class="max-w-7xl mx-5 md:mx-auto grid grid-cols-1 lg:grid-cols-4 gap-12 ">


            <!-- Sidebar Column (Right) -->
            <div class="col-span-3 md:col-span-1 bg-white rounded-lg shadow-md p-6">
                <!-- Search Section -->
                <div class="mb-6">
                    <h4 class="text-xl font-semibold mb-4">{{ __('Search...') }}</h4>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('Search...') }}" class="w-full p-2 border rounded-md">
                </div>

                <!-- Categories Section -->
                <div class="mb-6">
                    <h4 class="text-xl font-semibold mb-4">{{ __('Recommended topics') }}</h4>
                    <ul class="flex flex-wrap">
                        @foreach ($this->categories as $category)
                            <li class="mx-1 my-1">
                                <button wire:click="filterByCategory({{ $category->id }})"
                                    style="background-color: {{ $category->bg_color ?? '#f0f0f0' }}; color: {{ $category->text_color ?? '#333' }}"
                                    class="p-2 rounded-lg hover:bg-opacity-80 hover:text-white transition duration-300"
                                    aria-label="Filter by {{ $category->category }}">
                                    {{ Str::limit($category->category_name, 15) }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Clear Filter Button -->
                @if ($selectedCategory)
                    <div class="mt-4">
                        <button wire:click="removeCategoryFilter" class="text-red-500 hover:text-red-700">
                            {{ __('clear filter') }}
                        </button>
                    </div>
                @endif
            </div>

             <!-- Blog Posts Column (Left) -->
             <div class="col-span-3">
                <!-- Show Selected Category -->
                @if ($selectedCategory)
                    @php
                        $category = $this->categories->firstWhere('id', $selectedCategory);
                    @endphp

                    @if ($category)
                        <div class="mb-4 flex items-center justify-between bg-primary-light p-3 rounded-md">
                            <span>{{ __('messages.filtered_by') }}</span>
                            <span class="p-1 px-3 rounded-md" style="background-color: {{ $category->bg_color }}; color: {{ $category->text_color }}">
                                {{ $category->category_name }}
                                <button wire:click="removeCategoryFilter" class="bg-transparent hover:bg-primary-dark p-1 rounded-full">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                        </div>
                    @endif
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                    @foreach ($this->posts as $post)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:shadow-xl hover:scale-105 transition duration-300">
                            <a wire:navigate href="{{ route('post.show', ['slug' => $post->slug]) }}">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Blog Post Image" class="w-full h-56 object-cover">
                            </a>
                            <div class="p-6">
                                <h3 class="text-2xl font-semibold text-gray-900 mb-4 break-words">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 break-words line-clamp-3">
                                    {{ \Str::limit($post->content, 150) }}
                                </p>

                                <div class="flex justify-between">
                                    <!-- Like Button with Heart Icon -->
                                    {{-- <button wire:click="likePost({{ $post->id }})" class="flex items-center space-x-2 space-x-reverse">
                                        <i class="fa fa-heart {{ $this->userHasLiked($post->id) ? 'text-red-500' : 'text-gray-400' }} text-xl"></i>
                                        <span class="text-lg">{{ $post->likes->count() }}</span>
                                    </button> --}}

                                    <a wire:navigate href="{{ route('post.show', ['slug' => $post->slug]) }}"
                                        class="text-primary-light font-semibold hover:text-primary transition duration-300">
                                        {{ __('Read More') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $this->posts->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
