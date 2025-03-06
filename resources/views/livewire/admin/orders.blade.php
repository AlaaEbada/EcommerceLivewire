<div>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center mb-6"> Orders</h2>

        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 shadow-md rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">Product Name</th>
                        <th class="py-3 px-4 text-left">Quantity</th>
                        <th class="py-3 px-4 text-left">Price</th>
                        <th class="py-3 px-4 text-left">Payment Status</th>
                        <th class="py-3 px-4 text-left">Delivery Status</th>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-left">Delivered</th>
                        <th class="py-3 px-4 text-left">Print PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $order->product_title }}</td>
                            <td class="py-3 px-4">{{ $order->quantity }}</td>
                            <td class="py-3 px-4">${{ $order->price }}</td>
                            <td class="py-3 px-4">{{ $order->payment_status }}</td>
                            <td class="py-3 px-4">{{ $order->delivery_status }}</td>
                            <td class="py-3 px-4">
                                <img src="{{ asset('storage/' . $order->image) }}"
                                    alt="{{ $order->product_title }}"
                                    class="w-24 h-24 object-cover rounded-md">
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex gap-2">
                                    @if($order->delivery_status == 'Processing')
                                        <button wire:click="markAsDelivered({{ $order->id }})"
                                            onclick="return confirm('Are You Sure This Product Is Delivered?');"
                                            class="px-2 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                            Delivred
                                        </button>

                                        <button wire:click="cancelOrder({{ $order->id }})"
                                            onclick="return confirm('Are you sure you want to cancel this order?');"
                                            class="px-2 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                            Cancel Order
                                        </button>
                                    @elseif($order->delivery_status == 'Delivered')
                                        <span class="text-green-600 font-semibold">Order Delivered</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Order Canceled</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
