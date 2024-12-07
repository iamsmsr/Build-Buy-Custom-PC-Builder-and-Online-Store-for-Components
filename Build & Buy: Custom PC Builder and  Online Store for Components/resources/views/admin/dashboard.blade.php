@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<h2>Welcome to the Admin Dashboard</h2>

<!-- Logout Button -->
<a href="{{ route('admin.logout') }}">Logout</a>

<!-- Dropdown to Select Component Type (CPU, RAM, SSD) -->
<form action="{{ route('admin.dashboard.components', ['type' => request('type')]) }}" method="get">
    <select name="type" onchange="this.form.submit()">
        <option value="">Select a Component Type</option>
        <option value="cpu" {{ request('type') == 'cpu' ? 'selected' : '' }}>CPU</option>
        <option value="Memory" {{ request('type') == 'Memory' ? 'selected' : '' }}>RAM</option>
        <option value="ssd" {{ request('type') == 'ssd' ? 'selected' : '' }}>SSD</option>
    </select>
</form>

<!-- Add Print and Export Buttons Here -->
@if(isset($components) && $components->count() > 0)
    <div class="action-buttons">
        <button onclick="printSummary()" class="btn-action">Print Summary</button>
        <a href="{{ route('export.components', ['type' => request('type'), 'format' => 'excel']) }}" class="btn-action">Export to Excel</a>
    </div>
@endif

<!-- Display the table with components if type is selected -->
@if(isset($components) && $components->count() > 0)
    <div class="component-section">
        <h3>Components: {{ ucfirst($type) ?? 'All Types' }}</h3>
        <table id="component-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Quantity</th>
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
                    <td>{{ $component->quantity }}</td>
                    <td class="action">
                        <!-- Update Component Details Form -->
                        <form action="{{ route('update.component', $component->id) }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $component->name }}" placeholder="Component Name" required>
                            <input type="text" name="type" value="{{ $component->type }}" placeholder="Type" required>
                            <input type="text" name="brand" value="{{ $component->brand }}" placeholder="Brand" required>
                            <input type="number" step="0.01" name="price" value="{{ $component->price }}" placeholder="Price" required>
                            <input type="number" name="quantity" value="{{ $component->quantity }}" placeholder="Quantity" required>
                            <button type="submit" class="btn-action btn-quantity">Update</button>
                        </form>

                        <!-- Delete Component Form -->
                        <form action="{{ route('delete.component', $component->id) }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No components available for the selected type.</p>
@endif

<!-- Add New Component Form -->
<h3>Add a New Component ({{ ucfirst($type ?? 'All Types') }})</h3>
<form action="{{ route('add.component2') }}" method="post">
    @csrf
    <input type="text" name="name" placeholder="Component Name" required>
    <input type="text" name="type" value="{{ $type ?? '' }}" readonly>
    <input type="text" name="brand" placeholder="Brand" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <button type="submit">Add Component</button>
</form>

<script>
    function printSummary() {
        var printContents = document.getElementById('component-table').outerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = '<table>' + printContents + '</table>';
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    }
</script>
</body>
</html>
