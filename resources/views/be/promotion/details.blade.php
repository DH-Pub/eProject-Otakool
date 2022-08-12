@extends('be.layout.layout')
@section('title', 'Promotion Details')

@section('style-section')
    <style>
        .apply img {
            width: 5rem;
        }
    </style>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-1 col-md-10">
                    <div class="card-header">
                        <h3 class="card-title">Promotion Details</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>Id</td>
                                <td>{{ $promo->id }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $promo->name }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $promo->description }}</td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>
                                    @if ($promo->type == 0)
                                        -${{ $promo->amount }}
                                    @elseif ($promo->type == 1)
                                        -{{ $promo->amount }}%
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Period</td>
                                <td>
                                    <p>From: {{ $promo->start }}</p>
                                    <p>To: {{ $promo->end }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Applied Products</td>
                                <td class="apply row m-0">
                                    @foreach ($products as $p)
                                        <div class="col">
                                            <a class="col" href="{{ route('be.product.details', $p->id) }}">
                                                <img src="{{ asset('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}" alt="">
                                                <p>{{ $p->name }}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <a href="{{ route('be.promotion.edit', $promo->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a href="{{ route('be.promotion.delete', $promo->id) }}" class="btn btn-danger btn-sm float-right">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
