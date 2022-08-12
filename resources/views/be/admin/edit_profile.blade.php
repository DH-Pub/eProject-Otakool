@extends('be.layout.layout')
@section('title', 'Admin - Edit Profile')

@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Admin Profile</h3>
                        </div>

                        <form method="POST" action="{{ route('update.profile', $editData->id) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Id</label>
                                    <input type="text" class="form-control" id="id" name="id" value="{{ $editData->id }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" class="form-control" type="text" value="{{ $editData->name }}" id="name">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" class="form-control" type="text" value="{{ $editData->email }}" id="email">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    @if (Session::has('emailErr'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('emailErr') }}
                                        </div>
                                    @endif
                                </div>

                                @if (Auth::guard('admin')->user()->role == 'main')
                                <div class="form-group">
                                        <label for="role">Role</label>
                                        <div class="col-sm-12">
                                            <label class="radio-inline px-2">
                                                <input type="radio" name="role" value="main" {{ $editData->role == 'main' ? 'checked' : '' }}>
                                                Main Management
                                            </label>
                                            <label class="radio-inline px-2">
                                                <input type="radio" name="role" value="product" {{ $editData->role == 'product' ? 'checked' : '' }}>
                                                Product Management
                                            </label>
                                            <label class="radio-inline px-2">
                                                <input type="radio" name="role" value="order" {{ $editData->role == 'order' ? 'checked' : '' }}>
                                                Order Management
                                            </label>
                                            @error('role')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                @if (Auth::guard('admin')->user()->role == 'product')
                                <div class="form-group">
                                        <label for="role">Role</label>
                                        <div class="col-sm-12">
                                            <label class="radio-inline px-2">
                                                <input type="radio" name="role" value="product" checked {{ $editData->role == 'product' }}>
                                                Product Management
                                            </label>
                                        </div>
                                    </div>
                                @elseif(Auth::guard('admin')->user()->role == 'order')
                                <div class="form-group">
                                        <label for="role">Role</label>
                                        <div class="col-sm-12">
                                            <label class="radio-inline px-2">
                                                <input type="radio" name="role" value="order" {{ $editData->role == 'order' ? 'checked' : '' }}>
                                                Order Management
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="details">Details</label>
                                    <textarea name="details" id="details" class="form-control" rows="10">{{ $editData->details }}</textarea>                                
                                </div>

                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary" value="Update Profile">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection