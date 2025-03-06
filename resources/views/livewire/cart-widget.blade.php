<div x-data="{ open: false }" class="relative" wire:poll>
    <!-- زر فتح السلة -->
    <button @click="open = !open" class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 hover:text-green-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>

        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">{{ count($cartItems) }}</span>
    </button>

    <!-- قائمة السلة -->
    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-4">
        <h2 class="text-lg font-semibold mb-3"> Cart </h2>

        @forelse($cartItems as $item)
            <div class="flex justify-between items-center border-b py-2">
                <div>
                    <p class="font-bold">{{ $item->product_title }}</p>
                    <p class="text-gray-500">{{ $item->price }} EGP × {{ $item->quantity }}</p>
                </div>
                <button wire:click="removeItem({{ $item->id }})" class="text-red-500 font-bold text-xl">x</button>
            </div>
        @empty
            <p class="text-gray-500 text-center">Cart Is Empty </p>
        @endforelse

        <div class="mt-4">
            <a href="{{ route('cart.page') }}" class="block text-center bg-green-500 text-white py-2 rounded">Show Cart </a>
        </div>
    </div>
</div>
