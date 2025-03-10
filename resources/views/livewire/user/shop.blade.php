<section class="bg-gray-100 py-12 flex justify-center" id="products">
    <div class="container mx-auto px-4 max-w-7xl text-center">
        <!-- Search Form -->
        <div class="mb-8 max-w-lg mx-auto">
                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                    <input wire:model.live.debounce.500="search" type="text" name="search" placeholder="Search for something"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
        </div>
        <!-- Featured Products -->
        <section class="container mx-auto px-6 py-6 max-w-7xl">

            <!-- Success Message -->
            @if (session()->has('message'))
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative text-center mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden relative">
                        <div class="bg-gradient-to-b from-gray-200 to-white p-4 flex justify-center">
                            <a href="{{ route('product.show', $product->id) }}"><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                class=" object-contain"></a>
                        </div>
                        <div class="p-6">
                            <a href="{{ route('product.show', $product->id) }}">
                                <h3 class="text-xl text-gray-900 font-semibold">{{ $product->title }}</h3>
                            </a>
                            <p class="text-gray-500 text-sm mt-1">{{ $product->category->category_name }}</p>

                            <p class="text-green-600 font-bold mt-2 text-lg">
                                @if ($product->discount_price)
                                    <span class="text-red-500">${{ $product->discount_price }}</span>
                                    <del class="text-gray-400">${{ $product->price }}</del>
                                @else
                                    ${{ $product->price }}
                                @endif
                            </p>

                            <div class="flex items-center mt-3 space-x-2">
                                <input type="number" wire:model="quantity.{{ $product->id }}" min="1"
                                    class="w-16 text-gray-900 border rounded px-2" placeholder="1">
                                <button wire:click="addToCart({{ $product->id }})"
                                    class="w-full bg-green-600 text-white py-2 rounded-lg font-bold hover:bg-purple-700 transition">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </section>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
