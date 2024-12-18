<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Component Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 24px;
        }

        .main-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .details-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .image-section {
            flex: 1;
            text-align: center;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            border: 2px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .info-section {
            flex: 2;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .info-section h1 {
            margin-bottom: 15px;
            font-size: 28px;
            color: #333;
        }

        .info-section p {
            font-size: 18px;
            color: #555;
            margin: 8px 0;
        }

        .info-section p span {
            font-weight: bold;
            color: #333;
        }

        .info-section .status {
            display: inline-block;
            padding: 5px 10px;
            margin-top: 10px;
            border-radius: 5px;
            font-weight: bold;
            color: #fff;
        }

        .status.available {
            background-color: #28a745;
        }

        .status.out-of-stock {
            background-color: #dc3545;
        }

        /* Add Comment Form Styles */
        .add-comment {
            margin-top: 30px;
        }

        .add-comment h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .add-comment form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .add-comment textarea,
        .add-comment select,
        .add-comment input,
        .add-comment button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .add-comment textarea {
            resize: vertical;
        }

        .add-comment select {
            background-color: #f9f9f9;
            font-size: 16px;
        }

        .add-comment button {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        .add-comment button:hover {
            background-color: #555;
        }

        /* Message Styles */
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .message.success {
            background-color: #28a745;
            color: #fff;
        }

        .message.error {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>

<header>
    @include('header')
</header>

<div class="main-container">
    <!-- Component Details Section -->
    <div class="details-container">
        <!-- Image Section -->
        <div class="image-section">
            <img src="https://gratisography.com/wp-content/uploads/2023/06/gratisography-circuit-chip-02-free-stock-photo-1168x780.jpg" alt="Component Image">
        </div>
        <!-- Component Info Section -->
        <div class="info-section">
            <h1>Component Name: <span>{{ $component->name }}</span></h1>
            <p>Brand: <span>{{ $component->brand }}</span></p>
            <p>Price: <span>${{ number_format($component->price, 2) }}</span></p>
            <p>Status:
                <span class="status {{ strtolower(str_replace(' ', '-', $component->status)) }}">
                    {{ $component->status }}
                </span>
            </p>
        </div>
    </div>
</div>

<div class="add-comment">
    <h2>Add Your Review / Complaint / Request</h2>

    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif

    @if(session('user_name') !== 'Annonymous')
        <form action="{{ route('add.review', $component->id) }}" method="POST">
            @csrf
            <textarea name="comment" rows="4" placeholder="Enter your comment here..." required></textarea>
            <select name="type" required>
                <option value="comment">Comment</option>
                <option value="complaint">Complaint</option>
                <option value="request">Request</option>
            </select>
            <input type="number" name="stars" min="1" max="5" placeholder="Rate 1-5 stars" required>
            <button type="submit">Submit</button>
        </form>
    @else
        <p>Please sign in or sign up to leave a review.</p>
    @endif
</div>

<div class="reviews">
    <h3>Product Reviews</h3>

    @if($reviews->isEmpty())
        <p>No reviews yet for this product.</p>
    @else
        @foreach($reviews as $review)
            <div class="review">
                <p><strong>User Name:</strong> {{ $review->user_name }}</p> <!-- Show user name here -->
                <p><strong>Rating:</strong> {{ $review->star ?? 'N/A' }} / 5</p>
                <p><strong>Comment:</strong> {{ $review->comment }}</p>
            </div>
        @endforeach
    @endif
</div>



</body>
</html>
