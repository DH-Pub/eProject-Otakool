@extends('fe.layout.layout')
@section('title', 'My Cart')

@section('style-section')
    <style>
        .sticky-div {
            position: relative;
        }

        .sticky-div .order {
            position: -webkit-sticky;
            position: sticky;
            top: var(--scroll-padding, 54px);
        }
    </style>
@endsection

@section('content')
    <section>
        <div class="container">
            @if (isset($orderdetails) && $orderdetails->count() > 0)
                <div class="row">
                    <div class="col-xl-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderdetails as $od)
                                    <tr>
                                        <td class="col-5">
                                            <a class="row align-items-center" href="{{ route('details', $od->products->id) }}">
                                                <div class="cart-img col-lg-5">
                                                    <img class="img-fluid" src="{{ asset('images/' . $od->products->type . '/' . $od->products->folder . '/' . $od->products->cover) }}" alt="">
                                                </div>

                                                <div class="col-lg-7">
                                                    <strong>{{ $od->products->name }}</strong>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="align-middle">${{ $od->price }}</td>
                                        <td class="align-middle">{{ $od->quantity }}</td>
                                        <td class="align-middle">${{ $od->quantity * $od->price }}</td>
                                        <td class="align-middle">
                                            <a class="btn close-x" href="{{ route('cart.item.remove', $od->id) }}">
                                                <span class=""></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-xl-4 p-3 sticky-div">
                        <div class="order">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><strong>Total list price:</strong></td>
                                        <td class="text-end">${{ $listPrice }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Discount:</strong></td>
                                        <td class="text-end">-${{ $listPrice - $custCart->price }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Order total:</strong></td>
                                        <td class="text-end">
                                            ${{ $custCart->price }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Shipping & handling:</strong>
                                            <div class="text-muted">Seperated</div>
                                        </td>
                                        <td class="text-end">
                                            @if ($custCart->price > 30)
                                                <div class="text-muted">
                                                    Free
                                                </div>
                                            @else
                                                <div>$5</div>
                                                <small class="text-muted fs-6">
                                                    Free delivery for order above $30
                                                </small>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="ms-4">
                                <a href="{{ route('checkout', $custCart->id) }}" type="submit" class="btn btn-warning w-100">CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <p>Your cart is empty!</p>
                </div>
            @endif
        </div>
    </section>
@endsection
