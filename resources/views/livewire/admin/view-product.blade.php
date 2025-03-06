<div>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-3 rounded-md mb-4">
                {{ session()->get('message') }}
            </div>
        @endif

      <table>

                                <h2 class="text-2xl font-bold text-center mb-6">Show Products</h2>

                                <div class="overflow-x-auto">
                                    <table class="w-full border border-gray-300 shadow-md rounded-lg">
                                        <thead class="bg-gray-100 text-gray-700">
                                            <tr>
                                                <th class="py-3 px-4 text-left">Product Title</th>
                                                <th class="py-3 px-4 text-left">Description</th>
                                                <th class="py-3 px-4 text-left">Quantity</th>
                                                <th class="py-3 px-4 text-left">Category</th>
                                                <th class="py-3 px-4 text-left">Price</th>
                                                <th class="py-3 px-4 text-left">Discount Price</th>
                                                <th class="py-3 px-4 text-left">Product Image</th>
                                                <th class="py-3 px-4 text-left">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $item)
                                                {{-- تم تغيير المتغير لـ $products --}}
                                                <tr class="border-b">
                                                    <td class="py-3 px-4">{{ $item->title }}</td>
                                                    <td class="py-3 px-4">{{ $item->description }}</td>
                                                    <td class="py-3 px-4">{{ $item->quantity }}</td>
                                                    <td class="py-3 px-4">{{ optional($item->category)->category_name }}</td>
                                                    <td class="py-3 px-4">{{ $item->price }}</td>
                                                    <td class="py-3 px-4">{{ $item->discount_price }}</td>
                                                    <td class="py-3 px-4">
                                                        <img src="{{ asset('storage/' . $item->image) }}"
                                                            alt="{{ $item->title }}"
                                                            class="w-24 h-24 object-cover rounded-md">
                                                    </td>
                                                    <td class="py-3 px-4">
                                                        <div class="flex gap-2">
                                                            <a wire:navigate href="{{ route('admin.edit.product', $item->id) }}"
                                                                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                                                Edit
                                                            </a>

                                                            <button wire:click="deleteProduct({{ $item->id }})"
                                                                onclick="return confirm('Are you sure you want to delete this item?');"
                                                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

            </table>

    </div>

</div>
