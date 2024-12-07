<?php
use Illuminate\Support\Facades\Auth; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

<header>
    @include('header')
</header>

<main class="cart-container">
    <h2>Your Shopping Cart</h2>

    @if(!empty($cartItems))
        <table class="cart-table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['type'] }}</td>
                    <td>{{ $item['brand'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>
                        <a href="{{ route('cart.update', ['id' => $item['id'], 'quantity' => $item['quantity'] - 1]) }}" class="btn-update">-</a>
                        {{ $item['quantity'] }}
                        <a href="{{ route('cart.update', ['id' => $item['id'], 'quantity' => $item['quantity'] + 1]) }}" class="btn-update">+</a>
                    </td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="total-price-section">
            <h2>Total Price: $<span id="total-price">{{ number_format($totalPrice, 2) }}</span></h2>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif

    <div class="action-buttons">
        <a href="{{ route('reset.selections') }}" class="btn btn-reset">Reset</a>
        <button id="print-button" class="btn btn-print" onclick="printPage()">Print</button>
        <button id="screenshot-button" class="btn btn-screenshot" onclick="captureScreenshot()">Screenshot</button>

        <!-- Place Order Button -->
        @if(Auth::check())
            <form action="{{ route('place.order') }}" method="POST">
                @csrf
                <button type="submit" >Place Order</button>
            </form>
        @else
            <a href="{{ route('ecommerce.login') }}" >Login to Place Order</a>
        @endif
    </div>
</main>

<script>
    function printPage() {
        window.print();
    }

    function captureScreenshot() {
        html2canvas(document.body).then(canvas => {
            const screenshotLink = document.createElement('a');
            screenshotLink.href = canvas.toDataURL('image/png');
            screenshotLink.download = 'pc_builder_screenshot.png';
            screenshotLink.click();
        });
    }
</script>

</body>
</html>

