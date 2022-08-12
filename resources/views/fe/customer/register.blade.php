@extends('fe.layout.layout')
@section('title', 'Customer Register')

@section('content')
    <section id="register">
        <div class="container-fluid">
            <div class="row header">
                <div>
                    <h4>Create Account</h4>
                    <p>
                        Already have an account?
                        <a class="purple-link" href="{{ Route('customer.login') }}">Sign in here</a>
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form method="POST" action="{{ route('customer.postRegister') }}">
                        @csrf

                        <div class="cust-form">
                            <input type="text" id="name" name="name" class="cust-input shadow-none" value="{{ old('name') }}" placeholder= " ">
                            <label class="form-label" for="name">Name</label>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @if (Session::has('nameErr'))
                                <div class="alert alert-danger">
                                    {{ Session::get('nameErr') }}
                                </div>
                            @endif
                        </div>

                        <div class="cust-form">
                            <input type="text" id="username" name="username" class="cust-input shadow-none" value="{{ old('username') }}" placeholder= " ">
                            <label class="form-label" for="username">Username</label>
                            @error('username')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @if (Session::has('usernameErr'))
                                <div class="alert alert-danger">
                                    {{ Session::get('usernameErr') }}
                                </div>
                            @endif
                        </div>

                        <div class="cust-form">
                            <input type="email" id="email" name="email" class="cust-input shadow-none" value="{{ old('email') }}" placeholder= " ">
                            <label class="form-label" for="email">Email Address</label>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @if (Session::has('emailErr'))
                                <div class="alert alert-danger">
                                    {{ Session::get('emailErr') }}
                                </div>
                            @endif
                        </div>

                        <div class="cust-form">
                            <input type="number" id="tel" name="tel" class="cust-input shadow-none" value="{{ old('tel') }}" placeholder= " ">
                            <label class="form-label" for="tel">Phone Number</label>
                            @error('tel')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="cust-form">
                            <input type="text" id="address" name="address" class="cust-input shadow-none" value="{{ old('address') }}" placeholder= " ">
                            <label class="form-label" for="address">Address</label>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="cust-form">
                            <input type="password" id="password" name="password" class="cust-input shadow-none" placeholder= " ">
                            <label class="form-label" for="password">Password</label>
                            <!-- <small>Password must contain at least one letter, one number, 8 characters</small> -->
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            @if (Session::has('passErr'))
                                <div class="alert alert-danger">
                                    {{ Session::get('passErr') }}
                                </div>
                            @endif
                        </div>

                        <div class="cust-form">
                            <input type="password" id="confirm_password" name="confirm_password" class="cust-input shadow-none" placeholder= " ">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            @error('confirm_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <input type="submit" class="gradient-btn btn" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
