@extends('fe.layout.layout')
@section('title', 'Merchandise')

@section('content')
    @php
    $type = 'merchandise';
    @endphp
    <div class="container">
        <div class="row w-100">
            <aside class="col-lg-3">
                <h2>Merchandise</h2>

                <form action="" method="GET" class="d-flex">
                    <input type="search" class="form-control" name="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-warning" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>

                <h5>Search by Type</h5>
                <div class="ps-3">
                    <div><a href="{{ route('productShow', $type) }}?tag=">All</a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag=cosplay">Cosplay</a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag=keychain">Key chain</a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag=action"></a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag=romance"></a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag="></a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag="></a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag="></a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag="></a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag="></a></div>
                    <div><a href="{{ route('productShow', $type) }}?tag="></a></div>
                </div>
                <h5>Sort by</h5>
                <div class="ps-1">
                    <h6>Name</h6>
                    <div class="ps-2">
                        <div>
                            <a
                                href="{{ route('productShow', [
                                    'productType' => $type,
                                    'search' => request('search'),
                                    'tag' => request('tag'),
                                    'name' => 'asc',
                                ]) }}">
                                Ascending</a>
                            |
                            <a
                                href="{{ route('productShow', [
                                    'productType' => $type,
                                    'search' => request('search'),
                                    'tag' => request('tag'),
                                    'name' => 'desc',
                                ]) }}">Descending</a>
                        </div>
                    </div>
                    <h6>Release Date</h6>
                    <div class="ps-2">
                        <div>
                            <a
                                href="{{ route('productShow', [
                                    'productType' => $type,
                                    'search' => request('search'),
                                    'tag' => request('tag'),
                                    'release' => 'asc',
                                ]) }}">Ascending</a>
                            |
                            <a
                                href="{{ route('productShow', [
                                    'productType' => $type,
                                    'search' => request('search'),
                                    'tag' => request('tag'),
                                    'release' => 'desc',
                                ]) }}">Descending</a>
                        </div>
                    </div>
                    <h6>Ratings</h6>
                    <div class="ps-2">
                        <div>
                            <a
                                href="{{ route('productShow', [
                                    'productType' => $type,
                                    'search' => request('search'),
                                    'tag' => request('tag'),
                                    'rate' => 'asc',
                                ]) }}">Ascending</a>
                            |
                            <a
                                href="{{ route('productShow', [
                                    'productType' => $type,
                                    'search' => request('search'),
                                    'tag' => request('tag'),
                                    'rate' => 'desc',
                                ]) }}">Descending</a>
                        </div>
                    </div>
                </div>
            </aside>

            @include('fe.app.product.list')
        </div>
    </div>
@endsection
