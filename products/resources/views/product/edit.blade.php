@extends('layouts.master')

@section('title', 'Edit Produk')

@section('top', 'Edit Produk')

@section('content')
    <div class="section-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>

        </form>
    </div>
@endsection

