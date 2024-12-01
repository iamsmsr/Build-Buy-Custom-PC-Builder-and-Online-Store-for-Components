@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Builder - Main Page</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
<div class="container">
    <h1>PC Builder</h1>

    <div class="component-section">
        <!-- CPU Section -->
        <div class="component-category">
            <h2>CPU</h2>
            <div class="selected-product">
                <span><strong>Selected Product:</strong> {{ $selectedCpu->name ?? 'None' }}</span>
                <span><strong>Price:</strong> $<span id="cpu-price">{{ number_format($selectedCpu->price ?? 0, 2) }}</span></span>
            </div>
            <div class="quantity-controls">
                <span><strong>Quantity:</strong></span>
                <button type="button" onclick="updateQuantity('cpu', -1)">-</button>
                <span id="cpu-quantity" class="quantity-value">1</span>
                <button type="button" onclick="updateQuantity('cpu', 1)">+</button>
            </div>
            <div class="spacer"></div>
            <a href="{{ route('show.components', ['type' => 'CPU']) }}" class="btn">Select Component</a>
        </div>

        <!-- RAM Section -->
        <div class="component-category">
            <h2>RAM</h2>
            <div class="selected-product">
                <span><strong>Selected Product:</strong> {{ $selectedRam->name ?? 'None' }}</span>
                <span><strong>Price:</strong> $<span id="ram-price">{{ number_format($selectedRam->price ?? 0, 2) }}</span></span>
            </div>
            <div class="quantity-controls">
                <span><strong>Quantity:</strong></span>
                <button type="button" onclick="updateQuantity('ram', -1)">-</button>
                <span id="ram-quantity" class="quantity-value">1</span>
                <button type="button" onclick="updateQuantity('ram', 1)">+</button>
            </div>
            <div class="spacer"></div>
            <a href="{{ route('show.components', ['type' => 'Memory']) }}" class="btn">Select Component</a>
        </div>

        <!-- SSD Section -->
        <div class="component-category">
            <h2>SSD</h2>
            <div class="selected-product">
                <span><strong>Selected Product:</strong> {{ $selectedSsd->name ?? 'None' }}</span>
                <span><strong>Price:</strong> $<span id="ssd-price">{{ number_format($selectedSsd->price ?? 0, 2) }}</span></span>
            </div>
            <div class="quantity-controls">
                <span><strong>Quantity:</strong></span>
                <button type="button" onclick="updateQuantity('ssd', -1)">-</button>
                <span id="ssd-quantity" class="quantity-value">1</span>
                <button type="button" onclick="updateQuantity('ssd', 1)">+</button>
            </div>
            <div class="spacer"></div>
            <a href="{{ route('show.components', ['type' => 'SSD']) }}" class="btn">Select Component</a>
        </div>
    </div>

    <div class="total-price-section">
        <h2>Total Price: $<span id="total-price">{{ number_format($totalPrice, 2) }}</span></h2>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <button id="reset-button" class="btn" onclick="resetSelections()">Reset</button>
        <button id="print-button" class="btn" onclick="printPage()">Print</button>
        <button id="screenshot-button" class="btn" onclick="captureScreenshot()">Screenshot</button>
    </div>
</div>

<script>
    function updateQuantity(type, change) {
        const quantityElement = document.getElementById(type + '-quantity');
        const priceElement = document.getElementById(type + '-price');
        const totalPriceElement = document.getElementById('total-price');

        let quantity = parseInt(quantityElement.textContent);
        quantity = Math.max(1, quantity + change);
        quantityElement.textContent = quantity;

        let total = 0;

        ['cpu', 'ram', 'ssd'].forEach(component => {
            const compPrice = parseFloat(document.getElementById(component + '-price').textContent.replace(/,/g, ''));
            const compQuantity = parseInt(document.getElementById(component + '-quantity').textContent);
            total += compPrice * compQuantity;
        });

        totalPriceElement.textContent = total.toFixed(2);
    }

    function resetSelections() {
        window.location.href = "{{ route('reset.selections') }}";
    }

    function printPage() {
        window.print();
    }

    function captureScreenshot() {
        html2canvas(document.body).then(canvas => {
            const screenshotLink = document.createElement('a');
            screenshotLink.href = canvas.toDataURL('image/png');
            screenshotLink.download = 'pc_builder_screenshot.png';
            screenshotLink.click();
        });
    }
</script>
</body>
</html>
