@extends('layouts.master')

@section('title', 'Tambah Supplier')

@section('top', 'Tambah Supplier')

@section('content')
    <div class="section-body">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contact_info">Contact:</label>
                <input id="contact_info" type="text"  name="contact_info" class="form-control @error('contact_info') is-invalid @enderror" ></input>
                @error('contact_info')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Supplier</button>
        </form>
    </div>
@endsection
