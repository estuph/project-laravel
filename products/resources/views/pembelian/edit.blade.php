@extends('layouts.master')

@section('title', 'Edit Pembelian')

@section('top', 'Edit Pembelian')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Form Edit Pembelian</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('pembelians.update', $pembelian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <select name="supplier_id" class="form-control" required>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $pembelian->supplier_id == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <select name="product_id" class="form-control" required>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $pembelian->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Variant</label>
                    <select name="variant_id" class="form-control" required>
                        @foreach($variants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $pembelian->quantity }}" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="price" step="0.01" class="form-control" value="{{ $pembelian->price }}" required>
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" name="total" step="0.01" class="form-control" value="{{ $pembelian->total }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{route('pembelians.index')}}" class="btn btn-dark">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
