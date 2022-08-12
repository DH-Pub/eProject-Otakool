@extends('be.layout.layout')
@section('title', 'back end index')

@section('style-section')
    <style>
        .fa-size {
            font-size: 12rem;
        }
    </style>
@endsection

@section('content')
    {{-- BACK END INDEX --}}
    @php
    $role = Auth::guard('admin')->user()->role;
    @endphp

    <div>
        <h1 class="ml-2">Options</h1>
        <div class="row w-100">
            @if ($role == 'main')
                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ route('admin.index') }}">
                            <i class="fas fa-lock fa-size"></i>
                            <div class="card-body">
                                <h3>Admin</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ Route('customer.index') }}">
                            <i class="fas fa-users fa-size"></i>
                            <div class="card-body">
                                <h3>Customers</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ Route('be.feedback') }}">
                            <i class="fas fa-mail-bulk fa-size"></i>
                            <div class="card-body">
                                <h3>Feedbacks</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ Route('be.contact') }}">
                            <i class="fas fa-comment-alt fa-size"></i>
                            <div class="card-body">
                                <h3>Contacts</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ Route('be.qa') }}">
                            <i class="fas fa-question-circle fa-size"></i>
                            <div class="card-body">
                                <h3>Q&A</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ Route('be.news') }}">
                            <i class="fas fa-newspaper fa-size"></i>
                            <div class="card-body">
                                <h3>News</h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endif



            @if ($role == 'product' || $role == 'main')
                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ route('be.product') }}">
                            <i class="fas fa-boxes fa-size"></i>
                            <div class="card-body">
                                <h3>Products</h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ route('be.comment') }}">
                            <i class="fas fa-comments fa-size"></i>
                            <div class="card-body">
                                <h3>Comments</h3>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ route('be.promotion') }}">
                            <i class="fas fa-percent fa-size"></i>
                            <div class="card-body">
                                <h3>Promotions</h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endif


            @if ($role == 'order' || $role == 'main')
                <div class="col-lg-3 col-md-6 px-3 text-center">
                    <div class="card p-4">
                        <a href="{{ route('be.order') }}">
                            <i class="fas fa-truck-loading fa-size"></i>
                            <div class="card-body">
                                <h3>Orders</h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
@section('script-section')
@endsection
