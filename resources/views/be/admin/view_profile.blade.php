@extends('be.layout.layout')
@section('title', 'Admin - Profile')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Admin Profile</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td>Id</td>
                                    <td>{{ $adminData->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $adminData->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $adminData->email }}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>{{ $adminData->role }}</td>
                                </tr>
                                <tr>
                                    <td>Details</td>
                                    <td>{{ $adminData->details }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><a href="{{ route('edit.profile', $adminData->id) }}" class="btn btn-primary">Edit Profile</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection