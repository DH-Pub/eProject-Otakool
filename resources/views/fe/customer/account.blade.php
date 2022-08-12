@extends('fe.layout.layout')
@section('title', 'Customer Profile')

@section('content')
    <section id="myAccount">
        <div class="container">
            <div class="row">

                @include('fe.customer.customer_sidebar')

                <div class="col-md-8 offset-md-1">
                    <div class="card">

                        <h3 class="mt-3 text-center">Hi {{ $customer->name }} </h3>

                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="name">Name </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control shadow-none" id="name" readonly value="{{ $customer->name }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="username">Username </label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control shadow-none" id="username" readonly value="{{ $customer->username }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="email">Email </label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control shadow-none" id="email" readonly value="{{ $customer->email }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="tel">Tel </label>
                                <div class="col-sm-9">
                                    <input type="number" name="tel" class="form-control shadow-none" id="tel" readonly value="{{ $customer->tel }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="address">Address </label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control shadow-none" id="address" readonly value="{{ $customer->address }}">
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('customer.edit.account', $customer->id) }}" class="btn btn-primary">Edit Profile</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
