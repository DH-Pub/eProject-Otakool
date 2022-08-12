@extends('fe.layout.layout')
@section('title','Customer Profile')

@section('content')
<section id="myAccount">
    <div class="container">
        <div class="row">

            @include('fe.customer.customer_sidebar')

            <div class="col-md-2">

            </div>

            <div class="col-md-6">
                <div class="card">

                    <h3 class="mt-3 text-center">Hi {{ $editData->name }} </h3>

                    <form method="POST" action="{{ route('customer.update.account', $editData->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="name">Name </label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $editData->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('nameErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('nameErr') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="username">Username </label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" class="form-control" id="username" value="{{ $editData->username }}">
                                    @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('usernameErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('usernameErr') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="email">Email </label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email" value="{{ $editData->email }}">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    @if (Session::has('emailErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('emailErr') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tel">Tel </label>
                                <div class="col-sm-10">
                                    <input type="number" name="tel" class="form-control" id="tel" value="{{ $editData->tel }}">
                                    @error('tel')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="address">Address </label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" class="form-control" id="address" value="{{ $editData->address }}">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection