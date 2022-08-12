@extends('be.layout.layout')
@section('title', 'Hidden products')
@section('style-section')
    <style>
        img {
            height: 200px;
            width: 200px;
            display: block;
            margin: 0 auto;
            object-fit: contain;
        }
    </style>
@endsection
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
                        <h3 class="card-title">Products table</h3>
                    </div>

                    <div class="card-body">
                        <table id="product" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Product Hidden/ Deleted At</th>
                                    <th>Product Name</th>
                                    <th>Product Type</th>
                                    <th>Product Price</th>
                                    <th>Product Cover</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    <tr>
                                        <td>{{ $p->updated_at }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->type }}</td>
                                        <td>{{ $p->price }}</td>
                                        <td>
                                            @if (isset($p->cover))
                                                <img src="{{ url('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}" />
                                            @endif
                                        </td>

                                        {{-- option --}}
                                        <td class="text-left">
                                            <a class="btn btn-primary btn-sm" href="{{ Route('be.product.details', $p->id) }}">
                                                <i class="fas fa-folder"></i> View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{ Route('be.product.update', $p->id) }}">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm float-right" href="{{ Route('be.product.delete', $p->id) }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Type</th>
                                    <th>Product Price</th>
                                    <th>Product Status</th>
                                    <th>Product Cover</th>
                                    <th></th>
                                </tr>
                            </tfoot>
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
