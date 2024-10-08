@extends('layouts.custom')

@section('title', 'Login Page')

@section('content')
<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
    <div class="login-brand">
      {{-- <img src="/stisla/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
    </div>

    <div class="card card-primary">
      <div class="card-header"><h4>Login</h4></div>

      <div class="card-body">

            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif


        <form method="POST" action="{{route('login.process')}}" class="needs-validation" novalidate="">
          @csrf
          @method('POST')
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
            @error('password')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
              Login
            </button>
          </div>
        </form>

      </div>
    </div>
    <div class="mt-5 text-muted text-center">
      Don't have an account? <a href="{{route('register')}}">Create One</a>
    </div>
    <div class="simple-footer">
      Copyright &copy; 2024
    </div>
  </div>
@endsection