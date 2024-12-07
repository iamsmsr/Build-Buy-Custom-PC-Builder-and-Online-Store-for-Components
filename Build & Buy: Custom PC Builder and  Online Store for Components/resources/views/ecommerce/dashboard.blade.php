<?php use Illuminate\Support\Facades\Auth;?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        /* Basic button styles */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;

            font-weight: bold;
            cursor: pointer;
        }

        .btn-red {
            background-color: red;
        }

        .btn-green {
            background-color: green;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<header>
    @include('header')
</header>

<main class="dashboard-container">
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    <h2>Your Orders</h2>

    @if($orders->isEmpty())
        <p>You have not placed any orders yet.</p>
    @else
        <table class="orders-table">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Details</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Placed At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_id ?? 'N/A' }}</td>
                    <td>
                        <table class="order-details">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Item Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $details = json_decode($order->order_details, true);
                            @endphp
                            @if(is_array($details))
                                @foreach($details as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>${{ number_format($item['total_price'], 2) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">Order details not available.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form action="{{ route('payment.show', ['order_id' => $order->order_id]) }}" method="GET">
                            <button class="btn"
                                    data-status="{{ $order->status }}">
                                Make Payment
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

</main>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            const status = button.getAttribute('data-status');
            console.log('Button found with data-status:', status);

            if (status) {
                const normalizedStatus = status.toLowerCase();
                if (normalizedStatus === 'pending') {
                    button.classList.add('btn-red');
                } else {
                    button.classList.add('btn-green');
                }
            } else {
                console.warn('Missing data-status for button:', button);
            }
        });
    });
</script>

</body>
</html>
