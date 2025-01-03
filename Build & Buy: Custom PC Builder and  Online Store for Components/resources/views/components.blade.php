
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Builder</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
    <h1>PC Builder Components</h1>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Power Consumption</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($components as $component)
            <tr>
                <td>{{ $component->name }}</td>
                <td>{{ $component->type }}</td>
                <td>{{ $component->brand }}</td>
                <td>${{ number_format($component->price, 2) }}</td>
                <td>{{ $component->power }} watt</td>
                <td>
                    <!-- Add Button -->
                    <a href="{{ route('add.component1', ['type' => $component->type, 'id' => $component->id]) }}" class="btn-add">Add</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
