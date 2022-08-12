@extends('be.layout.layout')
@section('title', 'Q&A index')

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
                        <h3 class="card-title">Q&A table</h3>
                    </div>

                    <div class="card-body">
                        <table id="qa" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Q&A Created At</th>
                                    <th>Q&A Title</th>
                                    <th>Q&A Content</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($qas as $q)
                                <tr>
                                    <td>{{ $q->created_at }}</td>
                                    <td>{{ $q->title }}</td>
                                    <td>{!! $q->content !!}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('be.details.qa',$q->id) }}">
                                            <i class="fas fa-folder"></i>
                                            View
                                        </a>
                                        <a href="{{ route('be.edit.qa', $q->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        
                                        
                                        {{-- <a class="btn btn-danger btn-sm" href="{{ route('be.qa.delete', $q->id) }}">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </a> --}}

                                        <button class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modalDialog" data-product-name="{{ $q->title }}"
                                                data-product-id="{{ $q->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Q&A Created At</th>
                                    <th>Q&A Title</th>
                                    <th>Q&A Content</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal --}}
    <div class="modal fade" id="modalDialog" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalLabel">Are you sure you want to delete this Q&A?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h4 class="product-name-display"></h4>
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
@endsection

@section('script-section')
    <script>
        $(function() {
            $('#qa').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "info": true,
                "autoWidth": false,
                "columnDefs": [
                    { "width": "20%", "targets": 3 }
                ]
            });

            
            $('#modalDialog').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var productName = button.data('product-name');

                var productID = button.data('product-id');
                var url = "{{ Route('be.qa.delete', ':id') }}";
                url = url.replace(':id', productID);

                var modal = $(this);
                modal.find('.product-name-display').text(productName);
                modal.find('.modal-footer #delete-data').attr("href", url);
            })
        }());
    </script>
@endsection