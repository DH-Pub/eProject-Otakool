@extends('be.layout.layout')
@section('title', 'Customer - Profile')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Customer Profile</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>Id</td>
                                <td>{{ $customerData->id }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $customerData->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $customerData->email }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($customerData->status == '0')
                                    <span> Disable</span>
                                    @elseif($customerData->status == '1')
                                    <span> Active</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tel</td>
                                <td>{{ $customerData->tel }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $customerData->address }}</td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>{{ $customerData->username }}</td>
                            </tr>
                            <td></td>
                            <td>
                                <a href="{{ route('edit.customer.profile', $customerData->id) }}" class="btn btn-primary">Edit Profile</a>
                            </td>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection