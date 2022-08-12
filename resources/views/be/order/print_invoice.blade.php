@extends('be.layout.layout')
@section('title', 'Print Invoice')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex flex-row justify-content-between align-items-end">
                                        <h4 class="font-size-16"><strong>Invoice No # {{ $invoice->id }}</strong></h4>
                                        <img src="{{ asset('images/logo/otakool-logo.png') }}" alt="logo" height="50">
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 mt-4">
                                            <div>
                                                <strong>Otakool Shopping Store:</strong><br>
                                                Otaku's heaven<br>
                                                support@otakool.com
                                            </div>
                                        </div>
                                        <div class="col-6 mt-4">
                                            <strong>Invoice Date:</strong><br>
                                            {{ date('d-m-Y',strtotime($invoice->created_at)) }} <br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Customer Invoice</strong></h3>
                                        </div>
    
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Customer Name</strong></td>
                                                        <td><strong>Customer Tel</strong></td>
                                                        <td><strong>Customer Address</strong></td>
                                                        <td><strong>Customer Note</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> {{ $invoice->customers->name }}</td>
                                                        <td> {{ $invoice->contact }}</td>
                                                        <td> {{ $invoice->address }}</td>
                                                        <td> {{ $invoice->note }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @php
                            $order = App\Models\Order::where('id',$invoice->id)->first();
                        @endphp

                            <div class="row">
                                <div class="col-12 p-2">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td><strong>No</strong></td>
                                                    <td class="text-center"><strong>Type</strong></td>
                                                    <td class="text-center"><strong>Product Name</strong></td>
                                                    <td class="text-center"><strong>Quantity</strong></td>
                                                    <td class="text-center"><strong>Unit Price</strong></td>
                                                    <td class="text-center"><strong>Total Price</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($invoice['orderdetails'] as $key => $details)
                                                <tr>
                                                    <td class="text-center">{{ $key+1 }}</td>
                                                    <td class="text-center">{{ $details->products->type }}</td>
                                                    <td class="text-center">{{ $details->products->name }}</td>
                                                    <td class="text-center">{{ $details->quantity }}</td>
                                                    <td class="text-center">{{ $details->price }}</td>
                                                    <td class="text-center">
                                                        {{ $details->quantity * $details->price }}
                                                    </td>
                                                </tr>
                                                
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>   
                                                    <td></td>                            
                                                    <td class="text-center">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td class="text-center">${{ $order->price }}</td>
                                                </tr>        
                                            </tbody>
                                        </table>
                                    </div>

                                    <div>
                                        <a href="javascript:window.print()" class="btn btn-success"><i class="fa fa-print"></i></a>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
