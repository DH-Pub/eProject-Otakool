@extends('be.layout.layout')
@section('title', 'order index')

@section('style-section')
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
                        <h3 class="card-title">Order table</h3>
                    </div>

                    <div class="card-body">
                        <table id="order" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Order Created At</th>
                                    <th>Order ID</th>
                                    <th>Order Total</th>
                                    <th>Status</th>
                                    <th>Order Details</th>
                                    <th>By Customer</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $o)
                                    <tr>
                                        <td>
                                            <div>Created: {{ $o->created_at }}</div>
                                            <div>Updated: {{ $o->updated_at }}</div>
                                        </td>
                                        <td>{{ $o->id }}</td>
                                        <td>${{ $o->price }}</td>
                                        <td>{{ $o->status }}</td>
                                        <td>
                                            <div>Address: {{ $o->address }}</div>
                                            <div>Contact: {{ $o->contact }}</div>
                                            <div>Note: {{ $o->note }}</div>
                                        </td>
                                        <td>
                                            <p>Name: {{ $o->customers->name }}</p>
                                            <p>Username: {{ $o->customers->username }}</p>
                                            <p>Email: {{ $o->customers->email }}</p>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('be.order.details', $o->id) }}">Details</a>
                                            @if ($o->status != 'canceled')
                                                <a class="btn btn-sm btn-warning" href="{{ route('be.order.edit', $o->id) }}">Edit</a>
                                                <a href="{{ route('be.order.cancel', $o->id) }}" class="btn btn-sm btn-danger float-right">Cancel</a>
                                            @endif
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
            $('#order').DataTable({
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
