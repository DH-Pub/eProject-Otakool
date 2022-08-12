@extends('fe.layout.layout')
@section('title', 'Customer Profile')

@section('content')
    <section id="myAccount">
        <div class="container">
            <div class="row">

                @include('fe.customer.customer_sidebar')

                <div class="col-md-6 offset-md-2">
                    <div class="card">
                        <h3 class="mt-3 text-center">Change Your Password </h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('customer.update.password') }}">
                                {{ csrf_field() }}

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label" for="oldpassword">Current Password </label>
                                    <div class="col-lg-8 d-flex flex-column align-items-center">
                                        <input type="password" name="oldpassword" class="form-control" id="oldpassword">
                                        @error('oldpassword')
                                            <div class="alert alert-danger w-100">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label" for="newpassword">New Password </label>
                                    <div class="col-lg-8 d-flex flex-column align-items-center">
                                        <input type="password" name="newpassword" class="form-control" id="newpassword">
                                        @error('newpassword')
                                            <div class="alert alert-danger w-100">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label" for="confirm_password">Retype New Password </label>
                                    <div class="col-lg-8 d-flex flex-column align-items-center">
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                        @error('confirm_password')
                                            <div class="alert alert-danger w-100">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
