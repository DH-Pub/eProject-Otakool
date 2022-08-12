@extends('be.layout.layout')
@section('title', 'Admin - Register')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Register an admin</h3>
                        </div>

                        <form method="POST" action="{{ route('admin.postRegister') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>                                    
                                    <input name="name" class="form-control" type="text" id="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror                                   
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>                          
                                    <input name="email" class="form-control" type="text" id="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    @if (Session::has('emailErr'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('emailErr') }}
                                        </div>
                                    @endif                                    
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>                                     
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('passErr'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('passErr') }}
                                        </div>
                                    @endif                                   
                                </div>

                                <div class="form-group">
                                    <label for="confirm_pass">Confirm Password</label>                                   
                                    <input type="password" class="form-control" id="confirm_pass" name="confirm_pass">
                                    @if (Session::has('passErr'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('passErr') }}
                                        </div>
                                    @endif                                    
                                </div>

                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <div class="col-sm-12">
                                        <label class="radio-inline px-2">
                                            <input type="radio" name="role" value="main" {{ old('role') == 'main' ? 'checked' : '' }}>
                                            Main Management
                                        </label>
                                        <label class="radio-inline px-2">
                                            <input type="radio" name="role" value="product" {{ old('role') == 'product' ? 'checked' : '' }}>
                                            Product Management
                                        </label>
                                        <label class="radio-inline px-2">
                                            <input type="radio" name="role" value="order" {{ old('role') == 'order' ? 'checked' : '' }}>
                                            Order Management
                                        </label>
                                        @error('role')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea id="details" class="form-control" rows="3" name="details" placeholder="Enter details">{{ old('details') }}</textarea>          
                                </div>

                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary" value="Create">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
