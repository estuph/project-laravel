@extends('layouts.master')

@section ('title', 'Daftar Produk')

@section('top', 'Daftar Produk')

@section('content')
    <div class="section-header">
        <div class="section-header-button">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
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
        <table id="product-table" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning ">Edit</a>
                            <a href="{{ route('products.show', $product->id) }}"  class="btn btn-info ">Show</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method ('DELETE')
                                <button type="submit" class="btn btn-danger " onclick="return confirm('Yakin ingin menghapus pengeluaran ini?')">
                                    Delete
                                </button>
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
            $('#product-table').DataTable();
            });
    </script>
@endsection
