@include('header')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bottleneck Calculator</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<div class="container">
    <h1>Bottleneck Calculator</h1>
    <p>Select your desired components and calculate the bottleneck performance.</p>

    <div class="selected-components">
        <h2>Selected Components</h2>
        <ul>
            <li><strong>CPU:</strong> {{ $selectedCpu['name'] ?? 'None' }}</li>
            <li><strong>RAM:</strong> {{ $selectedRam['name'] ?? 'None' }}</li>
            <li><strong>SSD:</strong> {{ $selectedSsd['name'] ?? 'None' }}</li>
        </ul>
    </div>

    @if(session('bottleneck'))
        <div class="result">
            <h2>Bottleneck Score: {{ session('bottleneck') }}%</h2>
            @if(session('bottleneck') >= 70)
                <p style="color: green;"><strong>You are good to go!</strong></p>
            @else
                <p style="color: red;"><strong>Consider consulting an expert for optimization.</strong></p>
            @endif
        </div>
    @endif

    <form action="{{ route('bottleneck.calculate') }}" method="POST">
        @csrf
        <button type="submit" class="btn">Calculate Bottleneck</button>
    </form>

{{--    <a href="{{ route('home') }}" class="btn">Go Back</a>--}}
</div>
</body>
</html>
