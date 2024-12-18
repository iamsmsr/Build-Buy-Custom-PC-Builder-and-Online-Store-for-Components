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

<!-- Show Polls Button -->
<a href="{{ route('admin.show.polls') }}">
    <button>Refresh Polls</button>
</a>

<!-- Display Polls -->

<!-- Display Active Polls -->
<!-- Display All Polls -->
<div class="container">
    <h1>Manage Polls</h1>

    <table>
        <thead>
        <tr>
            <th>Question</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($polls) && $polls->count() > 0)
            @foreach($polls as $poll)
                <tr>
                    <td>{{ $poll->question }}</td>
                    <td>{{ $poll->option1 }} ({{ $poll->vote_count1 }} votes)</td>
                    <td>{{ $poll->option2 }} ({{ $poll->vote_count2 }} votes)</td>
                    <td>{{ $poll->option3 }} ({{ $poll->vote_count3 }} votes)</td>
                    <td>{{ $poll->option4 }} ({{ $poll->vote_count4 }} votes)</td>
                    <td>{{ $poll->is_active ? 'Active' : 'Inactive' }}</td>
                    <td class="action">
                        <!-- Toggle Poll Status -->
                        <form action="{{ route('admin.poll.toggle', $poll->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn-action {{ $poll->is_active ? 'btn-quantity' : '' }}" type="submit">
                                {{ $poll->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>

                        <!-- Delete Poll -->
                        <form action="{{ route('admin.poll.delete', $poll->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-action btn-delete" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" style="text-align: center;">No polls available.</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>




<h3>Create a New Poll</h3>
<form action="{{ route('admin.create.poll') }}" method="post">
    @csrf
    <input type="text" name="question" placeholder="Poll Question" required>
    <input type="text" name="option1" placeholder="Option 1" required>
    <input type="text" name="option2" placeholder="Option 2" required>
    <input type="text" name="option3" placeholder="Option 3" required>
    <input type="text" name="option4" placeholder="Option 4" required>
    <label for="is_active">Active</label>
{{--    <input type="checkbox" name="is_active" checked>--}}
    <button type="submit">Create Poll</button>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>

<h3>Create a New Coupon</h3>
<form action="{{ route('admin.coupons.create') }}" method="post">
    @csrf
    <input type="text" name="coupon_code" placeholder="Coupon Code" required>
    <input type="number" step="0.01" name="discount" placeholder="Discount (%)" required>
    <input type="date" name="expiry_date" placeholder="Expiry Date">
    <button type="submit">Create Coupon</button>
</form>

<div class="container">
    <h3>Manage Coupons</h3>

    <!-- Button to view active coupons -->
    <a href="{{ route('admin.coupons') }}" class="btn">Show Active Coupons</a>

    <table>
        <thead>
        <tr>
            <th>Code</th>
            <th>Discount (%)</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($coupons) && count($coupons) > 0)
            @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->coupon_code }}</td>
                    <td>{{ $coupon->discount }}</td>
                    <td class="action">
                        <!-- Update Form -->
                        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="post" style="display:inline;">
                            @method('PATCH')
                            @csrf
                            <input type="number" step="0.01" name="discount" value="{{ $coupon->discount }}" class="quantity-input" required>
                            <input type="date" name="expiry_date" value="{{ $coupon->expiry_date }}" class="quantity-input">
                            <button type="submit" class="btn-action btn-quantity">Update</button>
                        </form>

                        <!-- Delete Form -->
                        <form action="{{ route('admin.coupons.delete', $coupon->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn-action btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3" style="text-align: center;">No Coupons available.</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>





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
