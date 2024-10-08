@extends('layouts.master')

@section('title', 'Tambah Pembelian')

@section('top', 'Tambah Pembelian')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Form Tambah Pembelian</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('pembelians.create') }}" method="GET">
                <div class="form-group">
                    <label for="supplier_id">Nama Supplier:</label>
                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                        <option value="">Pilih Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_id">Produk:</label>
                    <select name="product_id" id="product_id" class="form-control" required onchange="this.form.submit()">
                        <option value="">Pilih Produk</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <form action="{{ route('pembelians.store') }}" method="POST">
                @csrf
                <input type="hidden" name="supplier_id" value="{{ request('supplier_id') }}">
                <input type="hidden" name="product_id" value="{{ request('product_id') }}">

                <div class="form-group">
                    <label for="variant_id">Variant:</label>
                    <select name="variant_id" id="variant_id" class="form-control" required>
                        <option value="">Pilih Variant</option>
                        @foreach($variants as $variant)
                            <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga:</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="created_at">Tanggal:</label>
                    <input type="date" name="created_at" id="created_at" class="form-control" required>
                </div>
                <input type="hidden" name="total" value="0">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

