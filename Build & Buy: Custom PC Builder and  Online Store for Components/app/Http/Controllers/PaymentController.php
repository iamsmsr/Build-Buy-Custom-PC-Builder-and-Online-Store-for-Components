<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Coupon;

class PaymentController extends Controller
{
    // Show the payment page
    public function showPaymentPage($order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Order not found.');
        }

        // Ensure discounted price is set
        $order->discounted_price = $order->discounted_price ?? $order->total_price;

        return view('payment', compact('order'));
    }

    // Apply a coupon code
    public function applyCoupon(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Order not found.');
        }

        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('coupon_code', $couponCode)->first();

        if ($coupon) {
            // Calculate the discounted price
            $discount = $coupon->discount / 100;
            $discountedPrice = $order->total_price * (1 - $discount);

            // Update order with discounted price
            $order->discounted_price = $discountedPrice;
            $order->save();

            return redirect()->back()->with('success', 'Coupon applied successfully!');
        }

        return redirect()->back()->with('error', 'Invalid or expired coupon.');
    }

    // Handle the payment form submission
    public function processPayment(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Order not found.');
        }

        $cardNumber = $request->input('card_number');
        $pin = $request->input('pin');

        // Dummy payment logic
        if ($cardNumber === '4111111111111111' && $pin === '1234') {
            $order->status = 'processing';
            $order->save();

            $paymentStatus = 'Payment Successful!';
        } else {
            $paymentStatus = 'Payment Failed! Invalid card or pin.';
        }

        return view('payment', compact('paymentStatus', 'order'));
    }
}
