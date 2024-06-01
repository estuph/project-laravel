<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        .container {
            width: 300px;
            margin: auto;
            padding: 10px;
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
        }
        .header p {
            margin: 2px 0;
            font-size: 12px;
        }
        .details {
            margin-bottom: 10px;
        }
        .details .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 12px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: right;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nota Penjualan</h1>
            <p>Nama Toko: Your Store Name</p>
            <p>Alamat: Your Store Address</p>
            <p>Telepon: Your Store Phone Number</p>
        </div>

        <div class="details">
            <div class="row">
                <div><strong>ID:</strong> {{ $penjualan->id }}</div>
                <div><strong>Tanggal:</strong> {{ $penjualan->tanggal }}</div>
            </div>
            <div class="row">
                <div><strong>Produk:</strong> {{ $penjualan->product->name }}</div>
                <div><strong>Variant:</strong> {{ optional($penjualan->variant)->name }}</div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $penjualan->quantity }}</td>
                    <td>Rp{{number_format($penjualan->price, 0, ',', '.')  }}</td>
                    <td>Rp{{number_format($penjualan->total, 0, ',', '.')  }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p><strong>Total: </strong>Rp{{number_format($penjualan->total, 0, ',', '.')}}</p>
        </div>
    </div>
</body>
</html>



