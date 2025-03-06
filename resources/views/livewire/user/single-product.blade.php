<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Product Image -->
        <div class="w-full">
            <img src="/storage/{{ $product->image }}" alt="{{ $product->title }}" class="w-full rounded-lg shadow-lg">
        </div>

        <!-- Product Details -->
        <div class="space-y-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ $product->title }}</h1>

            <p class="text-gray-600">{{ $product->description }}</p>

            <!-- Price Section -->
            <div class="flex items-center space-x-4">
                @if($product->discount_price)
                    <span class="text-2xl font-bold text-red-600">${{ $product->discount_price }}</span>
                    <span class="text-xl text-gray-400 line-through">${{ $product->price }}</span>
                @else
                    <span class="text-2xl font-bold text-gray-900">${{ $product->price }}</span>
                @endif
            </div>

            <!-- Add to Cart Form -->
            <form wire:submit.prevent="addToCart({{$productId}})" class="space-y-4">
                <div class="flex items-center space-x-4">
                    <label for="quantity" class="text-gray-700">Quantity:</label>
                    <input type="number" wire:model="quantity" min="1" value="1" id="quantity" class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-300">
                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                </button>
            </form>

            <!-- Product Specifications -->
            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Specifications</h3>
                <table class="w-full border-collapse">
                    <tbody>
                        <tr class="border-b">
                            <th class="py-2 px-4 bg-gray-100 text-left">Category</th>
                            <td class="py-2 px-4">{{ $product->category->category_name }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 bg-gray-100 text-left">Available Quantity</th>
                            <td class="py-2 px-4">{{ $product->quantity }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 bg-gray-100 text-left">Material</th>
                            <td class="py-2 px-4">100% Cotton</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 bg-gray-100 text-left">Size</th>
                            <td class="py-2 px-4">Medium</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Customer Reviews -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Reviews</h2>

        <div class="space-y-6">
            <div class="flex items-start space-x-4 p-6 bg-white rounded-lg shadow-md">
                <div class="w-12 h-12">
                    <img src="https://via.placeholder.com/60" alt="Customer Avatar" class="w-full h-full rounded-full">
                </div>
                <div class="flex-1">
                    <h5 class="text-lg font-semibold text-gray-900">John Doe</h5>
                    <div class="flex items-center space-x-1 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-gray-600 mt-2">Amazing product! Highly recommend.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session()->has('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg">
        {{ session('success') }}
    </div>
@endif
