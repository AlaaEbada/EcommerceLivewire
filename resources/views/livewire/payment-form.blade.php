<div class="max-w-md mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
    <h2 class="text-center text-xl font-semibold text-gray-700 mb-4">Complete Payment</h2>

    <form wire:submit.prevent="processPayment" id="payment-form">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Cardholder Name</label>
            <input type="text" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" wire:model.defer="name">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Stripe Card Element -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Card Details</label>
            <div id="card-element" class="p-2 border border-gray-300 rounded-md"></div>
            <div id="card-errors" class="text-red-500 text-xs mt-1"></div>
        </div>

        <button type="submit" class="w-full mt-4 bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-300" id="pay-btn">Pay Now</button>
    </form>
</div>

<!-- Include Stripe.js v3 -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const cardErrors = document.getElementById('card-errors');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Clear previous errors
            cardErrors.textContent = '';

            const { token, error } = await stripe.createToken(cardElement);

            if (error) {
                // Display error message
                cardErrors.textContent = error.message;
            } else {
                // Send the token to Livewire
                @this.set('stripeToken', token.id);
                @this.call('processPayment');
            }
        });
    });
</script>
