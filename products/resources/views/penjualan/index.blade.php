@extends('layouts.master')

@section('title', 'Daftar Penjualan')

@section('top', 'Daftar Penjualan')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
            @endif
            <div class="row mb-4">
                <div class="col-md-6">
                    <a href="{{ route('penjualans.create') }}" class="btn btn-primary mb-3">Add Penjualan</a>
                </div>
                <div class="col-md-6 text-right">
                    <form action="{{ route('penjualans.printByDate', date('Y-m-d')) }}" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <label for="tanggal" class="mr-2">Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control mr-2" value="{{ date('Y-m-d') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Cetak Nota</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table id="penjualan-table" class="table table-striped" style="width:100%">
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
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#penjualan-table').DataTable();
            });
    </script>
@endsection