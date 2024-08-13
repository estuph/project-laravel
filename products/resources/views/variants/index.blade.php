@extends('layouts.master')

@section('title', 'Daftar Variants')

@section('top', 'Daftar Variants')

@section('content')
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item active">Variants</div>
        </div>
    </div>

    <div class="section-body">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Variants List</h4>
                        <div class="card-header-action">
                            <a href="{{ route('variants.create') }}" class="btn btn-primary">Add Variant</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="variant-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($variants as $variant)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $variant->product->name }}</td>
                                            <td>{{ $variant->name }}</td>
                                            <td>Rp{{number_format($variant->price, 0, ',', '.')  }}</td>
                                            <td>{{ $variant->stock }}</td>
                                            <td>
                                                <a href="{{ route('variants.show', $variant->id) }}" class="btn btn-info">Show</a>
                                                <a href="{{ route('variants.edit', $variant->id) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route('variants.destroy', $variant->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengeluaran ini?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#variant-table').DataTable();
            });
    </script>
@endsection



