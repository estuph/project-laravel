@extends('layouts.master')

@section('title', 'Result')

@section('content')
<div class="container">
    <h2>Laporan dari {{ $tanggal_awal }} hingga {{ $tanggal_akhir }}</h2>
    <form action="{{ route('laporan.print') }}" target="_blank" method="POST" style="margin-bottom: 20px;">
        @csrf
        <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
        <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
        <button type="submit" class="btn btn-primary">Cetak PDF</button>
    </form>
    <table class="table table-bordered table-striped">
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
            @foreach ($reportData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['date'] }}</td>
                    <td>Rp {{ number_format($data['penjualan'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($data['pembelian'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($data['pendapatan'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-right"><strong>Total Pendapatan:</strong></td>
                <td><strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

