@extends('be.layout.layout')
@section('title', 'Order Details')

@section('style-section')
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-2 col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Order Details</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="order" class="table table-bordered table-hover">
                            <tr>
                                <td>Id</td>
                                <td>{{ $o->id }}</td>
                            </tr>
                            {{-- Products --}}
                            <tr>
                                <td>Products</td>
                                <td class="order-products">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderdetails as $od)
                                                @php
                                                    $p = $od->products;
                                                @endphp
                                                <tr>
                                                    <td class="col-5">
                                                        <a class="row align-items-center" href="{{ route('be.product.details', $p->id) }}">
                                                            <div class="cart-img col-lg-5">
                                                                <img class="img-fluid" src="{{ asset('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}" alt="">
                                                            </div>

                                                            <div class="col-lg-7">
                                                                <strong>{{ $p->name }}</strong>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle">${{ $od->price }}</td>
                                                    <td class="align-middle">{{ $od->quantity }}</td>
                                                    <td class="align-middle">${{ $od->quantity * $od->price }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            {{--  --}}
                            <tr>
                                <td>Order Total</td>
                                <td>${{ $o->price }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>{{ $o->status }}</td>
                            </tr>
                            <tr>
                                <td>By Customer</td>
                                <td>
                                    <p>Name: {{ $o->customers->name }}</p>
                                    <p>Username: {{ $o->customers->username }}</p>
                                    <p>Email: {{ $o->customers->email }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Details</td>
                                <td>
                                    <div>Address: {{ $o->address }}</div>
                                    <div>Contact: {{ $o->contact }}</div>
                                    <div>Note: {{ $o->note }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    @if ($o->status != 'canceled')
                                        <a class="btn btn-warning" href="{{ route('be.order.edit', $o->id) }}">Edit</a>
                                    @endif
                                    
                                    <a href="{{ route('be.order.print.invoice',$o->id) }}"  target="_blank" class="btn btn-danger" title="Print Invoice"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
