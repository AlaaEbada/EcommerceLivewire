<?php
namespace App\Livewire;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;

class PaymentForm extends Component
{
    public $name, $stripeToken;
    public $total_price;

    protected $rules = [
        'name' => 'required',
        'stripeToken' => 'required',
    ];

    public function mount($total)
    {
        $this->total_price = $total;
    }

    public function processPayment()
    {
        $this->validate();

        try {
            // Set Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a charge
            $charge = Charge::create([
                'amount' => $this->total_price * 100, // Convert to cents
                'currency' => 'usd',
                'source' => $this->stripeToken,
                'description' => 'Thanks For Payment',
            ]);

            // Get the authenticated user
            $user = Auth::user();
            $user_id = $user->id;

            // Get the user's cart items
            $cart_items = Cart::where("user_id", $user_id)->get();

            // Create orders for each cart item
            foreach ($cart_items as $cart) {
                Order::create([
                    'name' => $cart->name,
                    'email' => $cart->email,
                    'phone' => $cart->phone,
                    'address' => $cart->address,
                    'user_id' => $cart->user_id,
                    'product_title' => $cart->product_title,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                    'image' => $cart->image,
                    'product_id' => $cart->product_id,
                    'payment_status' => 'Paid',
                    'delivery_status' => 'Processing',
                ]);

                // Delete the cart item after creating the order
                $cart->delete();
            }

            // Flash success message
            session()->flash('success', 'Payment successful!');
        } catch (\Exception $e) {
            // Flash error message
            session()->flash('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.payment-form');
    }
}
