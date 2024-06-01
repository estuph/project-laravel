@extends('layouts.master')

@section('title', 'Variant Details')

@section('top', 'Variant Details')

@section('content')
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('variants.index') }}">Variants</a></div>
            <div class="breadcrumb-item active">Variant Details</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $variant->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <strong>Product  :</strong>
                            </div>
                            <div class="col-8">
                                <p>{{ $variant->product->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <strong>Name  :</strong>
                            </div>
                            <div class="col-8">
                                <p>{{ $variant->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <strong>Price  :</strong>
                            </div>
                            <div class="col-8">
                                <p>Rp{{number_format( $variant->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <strong>Stock  :</strong>
                            </div>
                            <div class="col-8">
                                <p>{{ $variant->stock }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('variants.index') }}" class="btn btn-dark">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
