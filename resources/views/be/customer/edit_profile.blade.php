@extends('be.layout.layout')
@section('title', 'Customer - Edit Profile')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Customer Profile</h3>
                        </div>

                        <form method="POST" action="{{ route('update.customer.profile', $editData->id) }}" enctype="multipart/form-data">
                            @csrf
                            
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
                                    @if (Session::has('nameErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('nameErr') }}
                                    </div>
                                    @endif
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

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div>
                                        <label class="radio-inline px-2"><input type="radio" name="status" value="0" {{ $editData->status == '0' ? 'checked' : '' }}> Disable</label>
                                        <label class="radio-inline px-2"><input type="radio" name="status" value="1" {{ $editData->status == '1' ? 'checked' : '' }}> Active</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tel">Tel</label>
                                    <input name="tel" class="form-control" type="number" value="{{ $editData->tel }}" id="tel">
                                    @error('tel')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input name="address" class="form-control" type="text" value="{{ $editData->address }}" id="address">
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input name="username" class="form-control" type="text" value="{{ $editData->username }}" id="username">
                                    @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('usernameErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('usernameErr') }}
                                    </div>
                                    @endif
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