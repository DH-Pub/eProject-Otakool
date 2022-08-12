@extends('be.layout.layout')
@section('title', 'product index')

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
                        <h3 class="card-title">Admins table</h3>
                    </div>

                    <div class="card-body">
                        <table id="admin" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Admin Name</th>
                                    <th>Admin Email</th>
                                    <th>Admin Role</th>
                                    <th>Admin Details</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $a)
                                    @if ($a->id == Auth::guard('admin')->user()->id)
                                        @continue
                                    @endif
                                    <tr>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->role }}</td>
                                        <td>{{ $a->details }}</td>
                                        <td class="text-left">
                                            <a class="btn btn-primary btn-sm" href="{{ route('admin.profile', $a->id) }}">
                                                <i class="fas fa-folder"></i>
                                                View
                                            </a>

                                            <a href="{{ route('edit.profile', $a->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>

                                            {{-- <a class="btn btn-danger btn-sm float-right" href="{{ route('admin.delete', $a->id) }}">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </a> --}}

                                            <button class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modalDialog" data-admin-name="{{ $a->name }}"
                                                data-admin-id="{{ $a->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Admin Name</th>
                                    <th>Admin Email</th>
                                    <th>Admin Role</th>
                                    <th>Admin Details</th>
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
                        <h4 id="modalLabel">You sure you want to delete this admin?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <h4 class="admin-name-display"></h4>
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
        {{--  --}}
    </section>
@endsection

@section('script-section')
    <script>
        $(function() {
            $('#admin').DataTable({
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
            var productName = button.data('admin-name');

            var adminID = button.data('admin-id');
            var url = "{{ Route('admin.delete', ':id') }}";
            url = url.replace(':id', adminID);

            var modal = $(this);
            modal.find('.admin-name-display').text(productName);
            modal.find('.modal-footer #delete-data').attr("href", url);;
        })
    </script>
@endsection
