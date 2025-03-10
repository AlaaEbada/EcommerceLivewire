<div class="single-post bg-gray-50">
    <!-- Hero Section -->
    <x-hero-section title="{{ $post->title }}" />

    <!-- Single Post Content -->
    <div class="mx-5 max-w-4xl md:mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-8 sm:my-12 lg:my-20">

        <!-- Post Image -->
        @if ($post->featured_image)
            <div class="relative">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover rounded-t-lg">
            </div>
        @endif

        <!-- Post Title and Meta Info -->
        <div class="px-4 sm:px-8 py-6 sm:py-10">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6 leading-tight">{{ $post->title }}</h1>

            <!-- Category and Date -->
            <div class="flex flex-wrap items-center text-gray-500 text-sm mb-8 space-x-4 sm:space-x-6">
                <span class="flex items-center space-x-2">
                    <strong class="text-gray-700">{{ __('Category') }}:</strong>
                    <span>{{ $post->category->category_name }}</span>
                </span>
                <span class="flex items-center space-x-2">
                    <strong class="text-gray-700">{{ __('posted on') }}</strong>
                    <span>{{ $post->created_at->format('F j, Y') }}</span>
                </span>
            </div>

            <!-- Post Body -->
            <div class="text-gray-700 leading-relaxed text-lg mb-6 sm:mb-10">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Like Button with Heart Icon -->
            <div class="flex items-center justify-between mb-8 sm:mb-10">
                {{-- <button wire:click="likePost({{ $post->id }})" class="flex items-center space-x-2 rtl:space-x-reverse group">
                    <i class="fa fa-heart text-xl transition {{ $this->userHasLiked($post->id) ? 'text-red-500' : 'text-gray-400 group-hover:text-red-500' }}"></i>
                    <span class="text-lg font-semibold text-gray-700 group-hover:text-red-500">
                        {{ $post->likes->count() }}
                    </span>
                </button> --}}
                <a wire:navigate href="{{ route('blog.page') }}" class="inline-block bg-green-600 text-white py-2 px-6 rounded-full font-semibold hover:bg-green-700 transition duration-300">
                    {{ __('Back to blog') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Comment Section -->
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 sm:p-8 mt-12 sm:mt-16">
        <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-6 border-b-2 pb-2">{{ __('Comments') }}</h2>

        <!-- Livewire Comment Section -->
        @livewire('user.comment-section', ['post_id' => $post->id])
    </div>

    <!-- Related Posts Section -->
    <div class="mx-5 max-w-4xl md:mx-auto mt-12 sm:mt-16 pb-6">
        <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-8">{{ __('Related posts') }}</h2>

        @if($relatedPosts)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($relatedPosts as $relatedPost)
                    <div class="bg-white shadow-lg rounded-lg hover:shadow-xl transition">
                        <a href="{{ route('post.show', $relatedPost->slug) }}" class="block">
                            <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="w-full h-48 object-cover rounded-t-lg">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800 hover:text-green-600">
                                <a href="{{ route('post.show', $relatedPost->slug) }}">
                                    {{ $relatedPost->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 mt-2 break-words">
                                {{ Str::limit($relatedPost->body, 100) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
