<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .container {
            width: 100%;
            margin: auto;
            padding: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
        }
        .header p {
            margin: 2px 0;
            font-size: 14px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laporan dari {{ $tanggal_awal }} hingga {{ $tanggal_akhir }}</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Penjualan</th>
                    <th>Pembelian</th>
                    <th>Pengeluaran</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($reportData as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data['date'] }}</td>
                        <td>Rp{{ number_format($data['penjualan'], 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($data['pembelian'], 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($data['pendapatan'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-right"><strong>Total Pendapatan:</strong></td>
                    <td><strong>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

