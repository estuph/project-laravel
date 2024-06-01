@extends('layouts.master')

@section('title', 'Tambah Produk')

@section('top', 'Tambah Produk')

@section('content')
    <div class="section-body">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </form>
    </div>
@endsection

