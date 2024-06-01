@extends('layouts.master')

@section('title', 'Daftar Pembelian')

@section('top', 'Daftar Pembelian')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pembelians.create') }}" class="btn btn-primary">Tambah Pembelian</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Supplier</th>
                        <th>Produk</th>
                        <th>Variant</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembelians as $index => $pembelian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ optional($pembelian->supplier)->name }}</td>
                        <td>{{ optional($pembelian->product)->name }}</td>
                        <td>{{ optional($pembelian->variant)->name }}</td>
                        <td>{{ $pembelian->quantity }}</td>
                        <td>Rp{{ number_format($pembelian->price, 0, ',', '.')  }}</td>
                        <td>Rp{{ number_format($pembelian->total, 0, ',', '.')  }}</td>
                        <td>
                            <a href="{{ route('pembelians.show', $pembelian->id) }}" class="btn btn-info btn-sm mb-2">Detail</a>
                            <a href="{{ route('pembelians.edit', $pembelian->id) }}" class="btn btn-warning btn-sm mb-2">Edit</a>
                            <form action="{{ route('pembelians.destroy', $pembelian->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pembelians->links() }}
        </div>
    </div>
</div>
@endsection