<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Your Orders</h1>

    @if(session()->has('message'))
        <div class="bg-green-100 text-green-800 p-3 rounded-md mb-4">{{ session('message') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 shadow-lg rounded-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-4">Product Name</th>
                    <th class="p-4">Quantity</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Payment Status</th>
                    <th class="p-4">Delivery Status</th>
                    <th class="p-4">Image</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($orders as $order)
                <tr class="hover:bg-gray-100 transition text-center">
                    <td class="p-4 text-gray-700">{{ $order->product_title }}</td>
                    <td class="p-4 text-gray-700">{{ $order->quantity }}</td>
                    <td class="p-4 font-semibold text-gray-900">${{ number_format($order->price, 2) }}</td>
                    <td class="p-4 text-gray-700">{{ $order->payment_status }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 text-white rounded-ful text-sm
                            {{ $order->delivery_status == 'Delivered' ? 'bg-green-500' : ($order->delivery_status == 'Canceled' ? 'bg-red-500' : 'bg-yellow-500') }}">
                            {{ $order->delivery_status }}
                        </span>
                    </td>
                    <td class="p-4">
                        <img src="/storage/{{ $order->image }}" class="w-20 h-20 object-cover rounded-md shadow-md">
                    </td>
                    <td class="p-4">
                        @if($order->delivery_status == 'Processing')
                            <button wire:click="cancelOrder({{ $order->id }})"
                                    class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded transition"
                                    onclick="return confirm('Are you sure you want to cancel this order?')">
                                Cancel
                            </button>
                        @elseif($order->delivery_status == 'Delivered')
                            <span class="text-green-600 font-bold">Delivered</span>
                        @else
                            <span class="text-red-600 font-bold">Canceled</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
