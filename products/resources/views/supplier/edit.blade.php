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
                <label for="contact_info">Contact Info:</label>
                <textarea id="contact_info" name="contact_info" class="form-control">{{ $supplier->contact_info }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Supplier</button>
            <a href="{{route('suppliers.index')}}" class="btn btn-dark">Back</a>
        </form>
    </div>
@endsection
