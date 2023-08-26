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
            display: block;
            overflow: auto;
            margin-bottom: 30px;
        }

        .header img {
            float: left;
            width: 150px;
        }

        .header h1 {
            float: right;
            margin-top: 50px;
        }

        .invoice-details {
            display: block;
            overflow: auto;
            margin-bottom: 30px;
        }

        .invoice-details div {
            float: left;
            width: 50%;
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
            text-align: right;
            margin-top: 20px;
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
            <img src="path/to/logo.png" alt="Logo">
            <h1>Invoice</h1>
        </div>

        <div class="invoice-details">
            <div>
                <h2>Billed To</h2>
                <p>John Smith</p>
                <p>123 Main St</p>
                <p>Anytown, USA 12345</p>
            </div>

            <div>
                <h2>Invoice Details</h2>
                <p class="invoice-number">Invoice #0001</p>
                <p>Date: May 11, 2023</p>
                <p>Due Date: June 10, 2023</p>
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
                <tr>
                    <td>Product A</td>
                    <td>2</td>
                    <td>$50.00</td>
                    <td>$100.00</td>
                </tr>
                <tr>
                    <td>Product B</td>
                    <td>1</td>
                    <td>$75.00</td>
                    <td>$75.00</td>
                </tr>
            </tbody>
        </table>

        <div class="thank-you">
            Thank you for your business!
        </div>
    </div>
</body>
</html