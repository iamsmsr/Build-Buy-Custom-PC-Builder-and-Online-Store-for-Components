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

<div class="featured-products">
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
</div>

<!-- Polling Section -->
<!-- Polling Section -->
<!-- Polling Section -->
<div class="poll-section">
    <h2>Active Polls</h2>

    <!-- Button to show the Polls -->
    <form action="{{ route('polls.show') }}" method="GET" style="margin-bottom: 20px;">
        <button type="submit" class="btn btn-primary">Participate in Poll</button>
    </form>

    <!-- Polls Display Section -->
    <div class="polls-display">
        @if(isset($polls) && $polls->isNotEmpty())
            @foreach($polls as $poll)
                <div class="poll-card">
                    <h3>{{ $poll->question }}</h3>

                    @if(session('user_name', 'Annonymous') === 'Annonymous')
                        <!-- If user is not logged in -->
                        <p class="alert alert-warning">Log in to participate in the poll.</p>
                    @else
                        <!-- Voting Form -->
                        <form action="{{ route('polls.vote', ['poll_id' => $poll->id]) }}" method="POST">
                            @csrf
                            <div class="poll-options">
                                <label>
                                    <input type="radio" name="poll_option" value="1" required>
                                    {{ $poll->option1 }}
                                </label><br>
                                <label>
                                    <input type="radio" name="poll_option" value="2">
                                    {{ $poll->option2 }}
                                </label><br>
                                <label>
                                    <input type="radio" name="poll_option" value="3">
                                    {{ $poll->option3 }}
                                </label><br>
                                <label>
                                    <input type="radio" name="poll_option" value="4">
                                    {{ $poll->option4 }}
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Vote</button>
                        </form>
                    @endif
                </div>
            @endforeach

        @else
            <!-- No Active Polls -->
            <p class="alert alert-info">No active polls at the moment. Check back later!</p>
        @endif
    </div>
</div>










</body>
</html>
