@extends('be.layout.layout')
@section('title', 'News index')

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
                        <h3 class="card-title">News table</h3>
                    </div>

                    <div class="card-body">
                        <table id="news" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>News Created At</th>
                                    <th>News Category</th>
                                    <th>News Image</th>
                                    <th>News Title</th>
                                    <th>News Content</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $n)
                                    <tr>
                                        <td>{{ $n->created_at }}</td>
                                        <td>{{ $n->category->news_category }}</td>
                                        <td class="w-10"><img class="img-fluid col-md-3" src="{{ url('images/news/' . $n->image) }}" /></td>
                                        <td>{{ $n->title }}</td>
                                        <td>
                                            <div>
                                                {{ strip_tags(Str::limit($n->content, 200)) }}
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('be.details.news', $n->id) }}">
                                                <i class="fas fa-folder"></i>
                                                View
                                            </a>

                                            <a href="{{ route('be.edit.news', $n->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>

                                            <button class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modalDialog" data-product-name="{{ $n->title }}"
                                                data-product-id="{{ $n->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>News Created At</th>
                                    <th>News Category</th>
                                    <th>News Image</th>
                                    <th>News Title</th>
                                    <th>News Content</th>
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
                    <h4 id="modalLabel">Are you sure you want to delete this News?</h4>
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
            $('#news').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "info": true,
                "autoWidth": false,
                "columnDefs": [{
                        "width": "10%",
                        "targets": 0
                    },
                    {
                        "width": "10%",
                        "targets": 1
                    },
                    {
                        "width": "30%",
                        "targets": 2
                    },
                ]
            });

            $('#modalDialog').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var productName = button.data('product-name');

                var productID = button.data('product-id');
                var url = "{{ Route('be.delete.news', ':id') }}";
                url = url.replace(':id', productID);

                var modal = $(this);
                modal.find('.product-name-display').text(productName);
                modal.find('.modal-footer #delete-data').attr("href", url);
            })
        }());
    </script>
@endsection
