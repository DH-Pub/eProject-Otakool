@extends('be.layout.layout')
@section('title', 'Customer index')

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
                    <h3 class="card-title">Customer table</h3>
                </div>

                <div class="card-body">
                    <table id="customer" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Tel</th>
                                <th>Customer Address</th>
                                <th>Customer Username</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $c)
                            <tr>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->tel }}</td>
                                <td>{{ $c->address }}</td>
                                <td>{{ $c->username }}</td>
                                <td>
                                    @if($c->status == '0')
                                    <span class="btn btn-secondary btn-sm">Disabled</span>
                                    @elseif($c->status == '1')
                                    <span class="btn btn-success btn-sm">Active</span>
                                    @endif
                                </td>
                                <td class="text-left">
                                    <a class="btn btn-primary btn-sm" href="{{ route('customer.profile',$c->id) }}">
                                        <i class="fas fa-folder"></i>
                                        View
                                    </a>
                                    <a href="{{ route('edit.customer.profile', $c->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>

                                    {{-- <a class="btn btn-danger btn-sm float-right" href="">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a> --}}

                                    {{-- <button class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modalDialog" data-customer-name="{{ $c->name }}" data-customer-id="{{ $c->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Tel</th>
                                <th>Customer Address</th>
                                <th>Customer Username</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modalDialog" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalLabel">You sure you want to delete this customer?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h4 class="customer-name-display"></h4>
                </div>

                <div class="modal-footer">
                    <a id="delete-data" class="btn btn-danger btn-sm float-left" href="">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                    <button class="btn btn-primary btn-sm float-right" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    {{-- --}}
</section>
@endsection

@section('script-section')
    <script>
        $(function() {
            $('#customer').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>

    <script>
        $('#modalDialog').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var customerName = button.data('customer-name');

            var customerID = button.data('customer-id');
            var url = "{{ Route('customer.delete', ':id') }}";
            url = url.replace(':id', customerID);

            var modal = $(this);
            modal.find('.customer-name-display').text(customerName);
            modal.find('.modal-footer #delete-data').attr("href", url);;
        })
    </script>
@endsection