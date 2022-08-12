@extends('be.layout.layout')
@section('title', 'Admin - Change Password')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Change Admin Password</h3>
                        </div>

                        <form method="POST" action="{{ route('update.password') }}">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="oldpassword">Current Password</label>
                                    <input name="oldpassword" class="form-control" type="password" id="oldpassword">
                                    @error('oldpassword')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="newpassword">New Password</label>
                                    <input name="newpassword" class="form-control" type="password" id="newpassword">
                                    @error('newpassword')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Retype New Password</label>
                                    <input name="confirm_password" class="form-control" type="password" id="confirm_password">
                                    @error('confirm_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary" value="Change Password">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection