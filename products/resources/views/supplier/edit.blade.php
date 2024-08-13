@extends('layouts.master')

@section('title', 'Edit Supplier')

@section('top', 'Edit Supplier')

@section('content')
    <div class="section-body">
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $supplier->name }}" required>
            </div>
            <div class="form-group">
                <label for="contact_info">Contact :</label>
                <input id="contact_info" type="text" class="form-control @error('contact_info') is-invalid @enderror" name="contact_info" value="{{ old('contact_info', $supplier->contact_info) }}">
                @error('contact_info')
                     <div class="invalid-feedback">
                         {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Supplier</button>
            <a href="{{route('suppliers.index')}}" class="btn btn-dark">Back</a>
        </form>
    </div>
@endsection
