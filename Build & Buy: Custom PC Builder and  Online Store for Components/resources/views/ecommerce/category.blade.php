<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - {{ ucfirst($category) }}</title>
    <link rel="stylesheet" href="{{ asset('css/ecommerce.css') }}">
</head>
<body>

<header>
    @include('header')
</header>

<main>
    <div class="categories">
        <a href="{{ route('ecommerce.category', ['category' => 'Monitor']) }}" class="category-btn">Monitor</a>
        <a href="{{ route('ecommerce.category', ['category' => 'CPU']) }}" class="category-btn">CPU</a>
        <a href="{{ route('ecommerce.category', ['category' => 'Memory']) }}" class="category-btn">RAM</a>
        <a href="{{ route('ecommerce.category', ['category' => 'SSD']) }}" class="category-btn">SSD</a>
        <a href="{{ route('ecommerce.category', ['category' => 'Accessories']) }}" class="category-btn">Accessories</a>
        <a href="{{ route('ecommerce.category', ['category' => 'Others']) }}" class="category-btn">Others</a>
    </div>

    <section class="category-products">
        <h2>Products in {{ ucfirst($category) }}</h2>

        @if(isset($components) && $components->count() > 0)
            <div class="product-grid">
                @foreach($components as $component)
                    <div class="product-card">
                        <p>{{ $component->name }}</p>
                        <span>${{ number_format($component->price, 2) }}</span>
                        <a href="{{ route('add.component', ['type' => $component->type, 'id' => $component->id]) }}" class="btn-add">Add To Cart</a>
{{--                        <a href="#" class="btn-details">See Details</a>--}}
                        <a href="{{ route('component.details', ['id' => $component->id]) }}" class="btn-details">See Details</a>

                    </div>
                @endforeach
            </div>
        @else
            <p>No products available in this category.</p>
        @endif
    </section>
</main>

</body>
</html>
