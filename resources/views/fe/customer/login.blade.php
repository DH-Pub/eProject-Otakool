@extends('fe.layout.layout')
@section('title', 'Customer Login')

@section('content')
    <section id="login">
        <div class="container-fluid">
            <div class="row header">
                <div>
                    <h4>Login</h4>
                    <p>
                        Don't have an account?
                        <a class="purple-link" href="{{ Route('customer.register') }}"> Sign up here</a>
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form method="POST" action="{{ route('customer.loggedIn') }}">
                        @csrf

                        <div class="cust-form mb-4">
                            <input type="email" id="email" name="email" class="cust-input shadow-none" value="{{ old('email') }}"  placeholder= " ">
                            <label class="form-label" for="email">Email Address</label>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="cust-form mb-4">
                            <input type="password" id="password" name="password" class="cust-input shadow-none" placeholder= " ">
                            <label class="form-label" for="password">Password</label>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="text-center">
                            <input type="submit" class="gradient-btn btn" value="Sign In">
                        </div>
                    </form>

                </div>
            </div>
    </section>

@endsection
