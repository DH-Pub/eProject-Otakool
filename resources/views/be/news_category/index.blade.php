@extends('be.layout.layout')
@section('title', 'News Category index')

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
                        <h3 class="card-title">News Category table</h3>
                    </div>

                    <div class="card-body">
                        <table id="news_category" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>News Category Created At</th>
                                    <th>News Category Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($newsCategory as $nc)
                                <tr>
                                    <td>{{ $nc->created_at }}</td>
                                    <td>{{ $nc->news_category }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('be.details.news.category',$nc->id) }}">
                                            <i class="fas fa-folder"></i>
                                            View
                                        </a>
                                        <a href="{{ route('be.edit.news.category', $nc->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>

                                        {{-- <a class="btn btn-danger btn-sm" href="{{ route('be.news.category.delete', $q->id) }}">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                        </a> --}}

                                        <button class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modalDialog" data-product-name="{{ $nc->news_category }}"
                                                    data-product-id="{{ $nc->id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>News Category Created At</th>
                                    <th>News Category Name</th>
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
            $('#news_category').DataTable({
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

            $('#modalDialog').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var productName = button.data('product-name');

                var productID = button.data('product-id');
                var url = "{{ Route('be.news.category.delete', ':id') }}";
                url = url.replace(':id', productID);

                var modal = $(this);
                modal.find('.product-name-display').text(productName);
                modal.find('.modal-footer #delete-data').attr("href", url);
            })
        }());
    </script>
@endsection