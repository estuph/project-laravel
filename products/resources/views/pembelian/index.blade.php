@extends('layouts.master')

@section('title', 'Daftar Pembelian')

@section('top', 'Daftar Pembelian')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('pembelians.create') }}" class="btn btn-primary">Add Pembelian</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table id="pembelian-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Supplier</th>
                        <th>Produk</th>
                        <th>Variant</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Actions</th>
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
                            <div class="d-flex align-items-center mb-2 ">
                                <a href="{{ route('pembelians.show', $pembelian->id) }}" class="btn btn-info btn-sm mr-2 ">Detail</a>
                                <a href="{{ route('pembelians.edit', $pembelian->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                            <div class="d-flex justify-content-center mb-2">
                                <form action="{{ route('pembelians.destroy', $pembelian->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('Yakin ingin menghapus pengeluaran ini?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#pembelian-table').DataTable();
            });
    </script>
@endsection