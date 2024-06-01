@extends('layouts.custom')

@section('title', 'Register')

@section('content')
<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
    <div class="login-brand">
        <img src="/stisla/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form action="{{route('register.process')}}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control" @error('name')is-invalide @enderror name="name" autofocus>
                        @error('name')
                        <div class="alert text-danger" role="alert">
                           {{ $message}}
                          </div>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" @error('email')is-invalide @enderror name="email">
                        @error('email')
                        <div class="alert text-danger" role="alert">
                           {{ $message}}
                          </div>
                        @enderror
                        <div class="invalid-feedback">
                            Please enter your email.
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-6">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="password" class="form-control pwstrength" @error('password')is-invalide @enderror data-indicator="pwindicator" name="password">
                        @error('password')
                        <div class="alert text-danger" role="alert">
                           {{ $message}}
                          </div>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="password2" class="d-block">Password Confirmation</label>
                        <input id="password2" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="simple-footer">
        Copyright &copy; Stisla 2018
    </div>
</div>
@endsection
