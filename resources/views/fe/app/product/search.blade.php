@extends('fe.layout.layout')
@section('title', 'Search for Products')

@section('content')
    <div class="container">
        <div class="row w-100">
            <aside class="col-lg-3">
                <h2>Search</h2>
                <h5>Sort by</h5>
                <div class="ps-1">
                    <h6>Name</h6>
                    <div class="ps-2">
                        <div>
                            <a href="{{ route('search', ['query' => request('query'), 'name' => 'asc']) }}">Ascending</a> |
                            <a href="{{ route('search', ['query' => request('query'), 'name' => 'desc']) }}">Descending</a>
                        </div>
                    </div>
                    <h6>Ratings</h6>
                    <div class="ps-2">
                        <div>
                            <a href="{{ route('search', ['query' => request('query'), 'rate' => 'asc']) }}">Ascending</a> |
                            <a href="{{ route('search', ['query' => request('query'), 'rate' => 'desc']) }}">Descending</a>
                        </div>
                    </div>
                    <h6>Release Date</h6>
                    <div class="ps-2">
                        <div>
                            <a href="{{ route('search', ['query' => request('query'), 'release' => 'asc']) }}">Ascending</a> |
                            <a href="{{ route('search', ['query' => request('query'), 'release' => 'desc']) }}">Descending</a>
                        </div>
                    </div>
                </div>
            </aside>

            @include('fe.app.product.list')
        </div>
    </div>
@endsection

@section('script-section')
@endsection
