<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    // Show the payment page
    public function showPaymentPage($order_id)
    {
        // Fetch order details using the order_id
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Order not found.');
        }

        return view('payment', compact('order'));
    }

    // Handle the payment form submission
    public function processPayment(Request $request, $order_id)
    {
        // Get order details
        $order = Order::find($order_id);

        if (!$order) {
            return redirect()->route('dashboard')->with('error', 'Order not found.');
        }

        // Dummy payment logic (can be extended later)
        $cardNumber = $request->input('card_number');
        $pin = $request->input('pin');
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
