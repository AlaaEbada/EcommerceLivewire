<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">🛒 Shopping Cart</h1>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-4 border">Product</th>
                    <th class="p-4 border">Title</th>
                    <th class="p-4 border">Price</th>
                    <th class="p-4 border">Quantity</th>
                    <th class="p-4 border">Total</th>
                    <th class="p-4 border">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @if($cartItems && $cartItems->isNotEmpty())
                @foreach ($cartItems as $cart)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="p-4 text-center">
                            <img src="/storage/{{ $cart->image }}" class="w-20 h-20 object-cover rounded-lg shadow-md">
                        </td>
                        <td class="p-4 text-center text-gray-800 font-semibold">{{ $cart->product_title }}</td>
                        <td class="p-4 text-center text-green-600 font-medium">${{ $cart->price }}</td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center">
                                <button wire:click="decreaseQuantity({{ $cart->id }})"
                                    class="bg-gray-300 text-gray-700 px-3 py-1 rounded-l-lg hover:bg-gray-400 transition">
                                    ➖
                                </button>
                                <span class="bg-gray-200 px-4 py-2 text-lg font-semibold">{{ $cart->quantity }}</span>
                                <button wire:click="increaseQuantity({{ $cart->id }})"
                                    class="bg-gray-300 text-gray-700 px-3 py-1 rounded-r-lg hover:bg-gray-400 transition">
                                    ➕
                                </button>
                            </div>
                        </td>
                        <td class="p-4 text-center text-gray-900 font-bold">${{ $cart->price * $cart->quantity }}</td>
                        <td class="p-4 text-center">
                            <button wire:click="removeItem({{ $cart->id }})"
                                class="bg-red-500 text-white px-3 py-2 rounded-lg shadow-md hover:bg-red-600 transition">
                                <i class="fe fe-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h5 class="text-2xl font-bold text-gray-800 mb-4">💳 Order Summary</h5>
        <div class="flex justify-between text-lg font-semibold mb-4">
            <span class="text-gray-700">Total</span>
            <span class="text-green-600">${{ $totalPrice }}</span>
        </div>

        <div class="flex gap-4">
            <button wire:click="cashOrder"
                class="w-full text-center bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600 transition">
                💵 Cash On Delivery
            </button>
            <a href="{{ url('/stripe', $totalPrice) }}"
                class="w-full text-center bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition">
                💳 Pay Using Card
            </a>
        </div>
    </div>
</div>
