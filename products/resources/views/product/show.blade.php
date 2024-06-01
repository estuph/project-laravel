@extends('layouts.master')

@section('title', 'Product Details')

@section('top', 'Product Details')

@section('content')
    @section('content')
    <div class="section-header">
        <h1>Product Details</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></div>
            <div class="breadcrumb-item active">Product Details</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $product->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <p>{{ $product->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <p>{{ $product->price }}</p>
                        </div>
                        <div class="form-group">
                            <label for="created_at">Created At</label>
                            <p>{{ $product->created_at }}</p>
                        </div>
                        <div class="form-group">
                            <label for="updated_at">Last Updated</label>
                            <p>{{ $product->updated_at }}</p>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Variants</h4>
                    </div>
                    <div class="card-body">
                        @if($product->variants->isEmpty())
                            <p>No variants available for this product.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product->variants as $variant)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $variant->name }}</td>
                                                <td>{{ $variant->stock }}</td>
                                                <td>{{ $variant->price }}</td>
                                                <td>
                                                    <a href="{{ route('variants.show', $variant->id) }}" class="btn btn-info">Show</a>
                                                    <a href="{{ route('variants.edit', $variant->id) }}" class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('variants.destroy', $variant->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('variants.create') }}" class="btn btn-primary">Add New Variant</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
