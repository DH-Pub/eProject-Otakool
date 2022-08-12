@extends('fe.layout.layout')
@section('title', 'My Orders')

@section('style-section')
    <style>
        .order-name {
            text-overflow: ellipsis;

            /* Required for text-overflow to do anything */
            white-space: nowrap;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <section id="myOrders">
        <div class="container">
            <div class="row">
                @include('fe.customer.customer_sidebar')

                <div class="col-md-10">
                    @if ($orders->count() > 0)
                        @foreach ($orders as $o)
                            <div class="card my-4 p-2">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        @foreach ($o->orderdetails as $od)
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <a class="row align-items-center" href="{{ route('details', $od->products->id) }}">
                                                        <div class="cart-img col-lg-5">
                                                            <img class="img-fluid" src="{{ asset('images/' . $od->products->type . '/' . $od->products->folder . '/' . $od->products->cover) }}"
                                                                alt="">
                                                        </div>

                                                        <div class="col-lg-7 order-name">
                                                            <strong>{{ $od->products->name }}</strong>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    ${{ $od->price }} &#215; {{ $od->quantity }} = ${{ $od->price * $od->quantity }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-4">
                                        <div class="col-md-6">
                                            <strong>Order total: </strong>${{ $o->price }}
                                        </div>
                                        @php
                                            switch ($o->status) {
                                                case 'pending':
                                                    $status = 'Pending';
                                                    break;
                                                case 'processing':
                                                    $status = 'Delivering';
                                                    break;
                                                case 'delivered':
                                                    $status = 'Delivered';
                                                    break;
                                                default:
                                                    $status = null;
                                                    break;
                                            }
                                        @endphp
                                        <div class="col-md-6">
                                            <strong>Status: </strong>{{ $status }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <span>{{ $orders->withQueryString()->links('pagination::bootstrap-5') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
