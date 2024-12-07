<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Order #{{ $order->order_id }}</title>
    <style>
        /* Basic styling for the form */
        .payment-form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .payment-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .payment-form button {
            width: 100%;
            padding: 10px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .payment-form button:hover {
            opacity: 0.8;
        }

        .status-message {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }

        .status-success {
            color: green;
        }

        .status-error {
            color: red;
        }
    </style>
</head>
<body>

<div class="payment-form">
    <h2>Make a Payment - Order #{{ $order->order_id }}</h2>
    <p>Total Price: ${{ number_format($order->total_price, 2) }}</p>

    <form method="POST" action="{{ route('payment.process', ['order_id' => $order->order_id]) }}">
        @csrf
        <label for="card_number">Card Number</label>
        <input type="text" id="card_number" name="card_number" required placeholder="Enter your card number">

{{--        <label for="expiry_date">Expiry Date</label>--}}
{{--        <input type="text" id="expiry_date" name="expiry_date" required placeholder="MM/YY">--}}

        <label for="pin">PIN</label>
        <input type="password" id="pin" name="pin" required placeholder="Enter your PIN">

        <button type="submit" id="payment-button">Make Payment</button>
    </form>

    @if(isset($paymentStatus))
        <div class="status-message {{ strpos($paymentStatus, 'Failed') === false ? 'status-success' : 'status-error' }}">
            {{ $paymentStatus }}
        </div>
    @endif
</div>

<script>
    // Basic form validation before submission
    document.getElementById('payment-button').addEventListener('click', function(event) {
        let cardNumber = document.getElementById('card_number').value;
        let pin = document.getElementById('pin').value;
        let expiryDate = document.getElementById('expiry_date').value;

        // Simple validation for non-empty fields and card number format
        if (!cardNumber || !pin ) {
            alert('Please fill in all fields.');
            event.preventDefault(); // Prevent form submission
        } else if (!/^\d{16}$/.test(cardNumber)) {
            alert('Invalid card number. Please enter a 16-digit number.');
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

</body>
</html>
