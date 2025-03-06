<div class=" text-white font-sans min-h-screen ">
     <!-- Hero Section -->
     <section class="bg-gray-400 text-black py-20 px-6 relative h-[80vh] flex items-center">
        <div class="max-w-7xl mx-auto flex items-center justify-between text-center sm:text-left">
            <!-- Left Content (Text) -->
            <div class="flex flex-col items-center sm:items-start space-y-6">
                <h1 class="lg:align-ar text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in leading-tight lg:rtl:text-right">
                    Welcome to Our Store
                </h1>
                <p class="lg:align-ar text-lg md:text-xl mb-8 animate-fade-in animation-delay-200 max-w-3xl mx-auto lg:rtl:text-right">
                    Discover the best products at unbeatable prices. Shop now and enjoy exclusive deals!
                </p>
                <a href="shop" wire:navigate
                    class="bg-gradient-to-r from-[#159957] to-[#155799] text-white px-8 py-4 rounded-md text-lg shadow-lg transition-colors duration-500 hover:bg-gradient-to-r hover:from-[#155799] hover:to-[#159957]">
                    Explore our products
                </a>
            </div>

            <!-- Right Content (Image) -->
            <div class="hidden sm:block relative w-1/2">
                <img src="/images/hero.jpg" alt="Illustration" class="w-full h-auto object-cover" />
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="container mx-auto px-6 py-16 max-w-7xl ">
        <h2 class="text-3xl text-black  font-bold text-center mb-10">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="bg-gray-100 text-black   p-6 rounded-lg shadow-lg">
                <p class="text-lg font-semibold">Phones</p>
            </div>
            <div class="bg-gray-100 text-black   p-6 rounded-lg shadow-lg">
                <p class="text-lg font-semibold">Laptops</p>
            </div>
            <div class="bg-gray-100 text-black   p-6 rounded-lg shadow-lg">
                <p class="text-lg font-semibold">Accessories</p>
            </div>
            <div class="bg-gray-100 text-black   p-6 rounded-lg shadow-lg">
                <p class="text-lg font-semibold">Gaming</p>
            </div>
        </div>
    </section>

   <!-- Featured Products -->
<section class="container mx-auto px-6 py-16 max-w-7xl">
    <h2 class="text-3xl font-bold text-center text-black mb-10">Explore our Products</h2>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative text-center mb-4">
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


</div>
