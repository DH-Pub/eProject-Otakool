@php
$id = Auth::guard('customer')->user()->id;
$customer = App\Models\Customer::find($id);
@endphp


<div class="col-md-2">
    <div class="user mb-2 d-flex">
        <i class="icon fa fa-user align-self-center fs-1 pe-3 text-muted"></i>
        <div class="d-flex flex-column">
            Account of <strong class="name>">{{ $customer->name }}</strong>
        </div>
    </div>
    <ul class="list-group list-group-flush">
        <a href="{{ route('index') }}" class="btn btn-primary mb-2">Home</a>

        <a href="{{ route('customer.account') }}" class="btn btn-primary mb-2">My Profile</a>

        <a href="{{ route('customer.change.password') }}" class="btn btn-primary mb-2">Change Password </a>

        <a href="{{ route('my.orders') }}" class="btn btn-primary mb-2">My Orders</a>

        <a href="{{ route('customer.logout') }}" class="btn btn-danger mb-2">Logout</a>
    </ul>
</div>
