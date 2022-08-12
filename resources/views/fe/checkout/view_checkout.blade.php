@extends('fe.layout.layout')
@section('title', 'Checkout')

@section('content')
    <section class="container">
        <form method="post" action="{{ route('checkout.complete', $cart->id) }}">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <h4>Checkout</h4>

                    <div class="row justify-content-center my-4">

                        <div class="form-group row mb-2">
                            <div class="col-lg-3">
                                <label for="address" class="form-label fw-bold">Address:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="address" id="address" class="form-control" value="{{ $cart->customers->address }}">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-lg-3">
                                <label for="contact" class="form-label fw-bold">Contact Number:</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="contact" id="contact" class="form-control" value="{{ $cart->customers->tel }}">
                                @error('contact')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-lg-3">
                                <label for="note" class="form-label fw-bold">Note:</label>
                            </div>
                            <div class="col-lg-9">
                                <textarea class="form-control" name="note" id="note" rows="5" placeholder="If there are any thing else you want us to know for delivery"></textarea>
                                @error('note')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <h5>Payment Method</h5>
                    <div class="card col-md-4">
                        <div class="card-body">
                            <div>
                                <strong>Card number: </strong>
                                <p>*************111</p>
                            </div>
                            <div>
                                <strong>Name: </strong>
                                <p>AAA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <strong>Order total:</strong>
                        ${{ $cart->price }}
                    </div>
                    <button type="submit" class="btn btn-warning w-100">
                        Place order
                    </button>
                </div>
            </div>
        </form>
    </section>
@endsection
