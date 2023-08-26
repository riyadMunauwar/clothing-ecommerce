<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 150px;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-details div {
            flex: 1;
            text-align: center;
        }

        .invoice-number {
            font-size: 24px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        .total {
            display: flex;
            justify-content: flex-end;
        }

        .total span {
            font-weight: bold;
        }

        .thank-you {
            text-align: center;
            font-size: 24px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo">
            <h1>Invoice</h1>
        </div>

        <div class="invoice-details">
            <div>
                <h2>Billed To</h2>
                <p>{{ $customer_name }}</p>
                <p>{{ $customer_address }}</p>
                <p>{{ $customer_city }}, {{ $customer_state }} {{ $customer_zip }}</p>
            </div>

            <div>
                <h2>Invoice Details</h2>
                <p class="invoice-number">Invoice #{{ $invoice_number }}</p>
                <p>Date: {{ $invoice_date }}</p>
                <p>Due Date: {{ $due_date }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>{{ $item['total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <span>Total:</span> {{ $total }}
        </div>

        <div class="thank-you">
            Thank you for your business!
        </div>
    </div>
</body>
</html>
This template includes a header






