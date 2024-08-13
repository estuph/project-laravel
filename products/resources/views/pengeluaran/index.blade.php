@extends('layouts.master')

@section('title', 'Daftar Pengeluaran')
@section('top', 'Daftar Pengeluaran')

@section('content')
<div class="container">
    <a href="{{ route('pengeluarans.create') }}" class="btn btn-primary mb-3">Add Pengeluaran</a>
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
    <table id="pengeluaran-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluarans as $pengeluaran)
            <tr>
                <td>{{ $loop->iteration  }}</td>
                <td>{{ $pengeluaran->tanggal }}</td>
                <td>{{ $pengeluaran->keterangan }}</td>
                <td>Rp{{number_format( $pengeluaran->jumlah, 0,',', '.') }}</td>
                <td>
                    <a href="{{ route('pengeluarans.show', $pengeluaran->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('pengeluarans.edit', $pengeluaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pengeluarans.destroy', $pengeluaran->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengeluaran ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#pengeluaran-table').DataTable();
            });
    </script>
@endsection