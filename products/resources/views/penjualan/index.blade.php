@extends('layouts.master')

@section('title', 'Daftar Penjualan')

@section('top', 'Daftar Penjualan')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Penjualan</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <a href="{{ route('penjualans.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="w-6">ID</th>
                            <th>Nama Produk</th>
                            <th>Nama Variant</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualans as $penjualan)
                        <tr>
                            <td class="w-6">{{ $penjualan->id }}</td>
                            <td>{{ $penjualan->product->name }}</td>
                            <td>{{ optional($penjualan->variant)->name }}</td>
                            <td>{{ $penjualan->tanggal }}</td>
                            <td>{{ $penjualan->quantity }}</td>
                            <td>Rp{{ number_format($penjualan->price, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($penjualan->total, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex mt-2">
                                    <a href="{{ route('penjualans.show', $penjualan->id) }}" class="btn btn-info btn-sm mr-1">Detail</a>
                                    <a href="{{ route('penjualans.edit', $penjualan->id) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
                                </div>
                                <div class="d-flex mt-2">
                                    <form action="{{ route('penjualans.destroy', $penjualan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus penjualan ini?')" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <a href="{{ route('penjualans.print', $penjualan->id) }}" class="btn btn-primary btn-sm">Cetak</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $penjualans->links() }}
        </div>
    </div>
</div>
@endsection
