@include('header')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build & Buy: Custom PC Builder and Online Store for Components</title>
    <link rel="stylesheet" href="{{ asset('css/ecommerce.css') }}">
</head>
<body>

<div class="search-bar">
    <input type="text" placeholder="Search for components..." id="searchInput">
    <button class="btn-search">Search</button>
</div>

<div class="categories">
    <a href="{{ route('ecommerce.category', ['category' => 'Monitor']) }}" class="category-btn">Monitor</a>
    <a href="{{ route('ecommerce.category', ['category' => 'CPU']) }}" class="category-btn">CPU</a>
    <a href="{{ route('ecommerce.category', ['category' => 'Memory']) }}" class="category-btn">RAM</a>
    <a href="{{ route('ecommerce.category', ['category' => 'SSD']) }}" class="category-btn">SSD</a>
    <a href="{{ route('ecommerce.category', ['category' => 'Accessories']) }}" class="category-btn">Accessories</a>
    <a href="{{ route('ecommerce.category', ['category' => 'Others']) }}" class="category-btn">Others</a>
</div>

<!-- Featured Products (Dummy) -->
<section class="featured-products">
    <h2>Featured Products</h2>
    <div class="product-category">
        <h3>Monitor</h3>
        <div class="product-grid">
            <div class="product-card">
                <p>Monitor 1</p>
                <span>$200</span>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="product-card">
                <p>Monitor 2</p>
                <span>$250</span>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="product-card">
                <p>Monitor 3</p>
                <span>$300</span>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>
        <button class="view-more-btn">View More</button>
    </div>
</section>

<script>
    function redirectTo(page) {
        alert('Functionality for ' + page + ' will be implemented later.');
    }
</script>

</body>
</html>
