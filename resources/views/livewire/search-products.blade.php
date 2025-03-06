<div class="relative w-full">
    <input type="text" wire:model.live.debounce.500ms="query"
        placeholder="Search products..."
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">

    @if (!empty($products))
        <ul class="absolute w-full bg-white border border-gray-200 mt-1 rounded-lg shadow-lg z-50 max-h-60 overflow-y-auto">
            @foreach ($products as $product)
                <li class="px-4 py-3 hover:bg-gray-100 cursor-pointer flex items-center space-x-3">

                    <a class="w-full" href="{{ route('product.show', $product->id) }}">
                        <!-- صورة المنتج -->
                        <img src="storage/{{ $product->image }}" alt="{{ $product->title }}"
                        class="w-14 h-14 object-cover rounded-md border border-gray-300">

                        <!-- تفاصيل المنتج -->
                        <div class="flex flex-col">
                        <span class="text-gray-800 font-medium">{{ $product->title }}</span>

                        @if ($product->discount_price && $product->discount_price < $product->price)
                            <span class="text-red-600 font-semibold">
                                ${{ number_format($product->discount_price, 2) }}
                            </span>
                            <span class="text-gray-500 line-through text-sm">
                                ${{ number_format($product->price, 2) }}
                            </span>
                        @else
                            <span class="text-green-600 font-semibold">
                                ${{ number_format($product->price, 2) }}
                            </span>
                        @endif
                        </div>
                    </a>

                </li>
            @endforeach
        </ul>
    @endif
</div>
