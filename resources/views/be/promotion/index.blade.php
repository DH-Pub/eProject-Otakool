@extends('be.layout.layout')
@section('title', 'Promotions')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ Route('be') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Promotions table</h3>
                    </div>

                    <div class="card-body">
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Created At</th>
                                    <th>Name & Description</th>
                                    <th>Promotion Amount</th>
                                    <th>Promotion period</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promotions as $promo)
                                    <tr>
                                        <td>{{ $promo->created_at }}</td>
                                        <td>
                                            <p>Name: {{ $promo->name }}</p>
                                            <p>Description: {{ $promo->description }}</p>
                                        </td>
                                        <td>
                                            @if ($promo->type == 0)
                                                -${{ $promo->amount }}
                                            @elseif ($promo->type == 1)
                                                -{{ $promo->amount }}%
                                            @endif
                                        </td>
                                        <td>
                                            <p>From: {{ $promo->start }}</p>
                                            <p>To: {{ $promo->end }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ route('be.promotion.details', $promo->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-folder"></i> Details
                                            </a>
                                            <a href="{{ route('be.promotion.edit', $promo->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a href="{{ route('be.promotion.delete', $promo->id) }}" class="btn btn-danger btn-sm float-right">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script-section')
    <script>
        $(function() {
            $('#product').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "info": true,
                "autoWidth": false,
            });

        }());
    </script>
@endsection
