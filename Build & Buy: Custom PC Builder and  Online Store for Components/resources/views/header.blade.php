<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build & Buy: Custom PC Builder and Online Store for Components</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<body>
<header class="header-container">
    <div class="header-left">
        <!-- Sign In, Sign Up buttons with updated routes -->
        <a href="{{ route('ecommerce.register') }}" class="btn">Sign Up</a>
        <a href="{{ route('ecommerce.login') }}" class="btn">Sign In</a>
        <!-- Admin Login button linked to admin login page -->
        <a href="{{ route('admin.login') }}" class="btn">Admin Login</a>
        <a href="{{ route('main.page') }}" class="btn">Main Page</a>
    </div>
    <div class="header-center">
        <h1>Build & Buy: Custom PC Builder and Online Store for Components</h1>
    </div>
    <div class="header-right">
        <!-- Cart button with dynamic item count -->
        <a href="{{ route('cart.page') }}" class="cart-btn">
            Cart ({{ count(session('cart', [])) }})
        </a>
    </div>
    <div class="header-right">
        <!-- User info (dynamically shows 'Annonymous' by default) -->
        <span class="user-info">
    User: {{ session('user_name', 'Annonymous') }}
        </span>
    </div>
</header>

<script>
    function redirectTo(page) {
        alert('Functionality for ' + page + ' will be implemented later.');
    }
</script>
</body>
</html>
