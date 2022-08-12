@extends('be.layout.layout')
@section('title', 'contact index')

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
                        <h3 class="card-title">Contact table</h3>
                    </div>

                    <div class="card-body">
                        <table id="contact" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Contact Made At</th>
                                    <th>Contact Name</th>
                                    <th>Contact Email</th>
                                    <th>Contact Title</th>
                                    <th>Contact Content</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $c)
                                    <tr>
                                        <td>{{ $c->created_at }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td>{{ $c->title }}</td>
                                        <td>{{ $c->content }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Contact Made At</th>
                                    <th>Contact Name</th>
                                    <th>Contact Email</th>
                                    <th>Contact Title</th>
                                    <th>Contact Content</th>
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
            $('#contact').DataTable({
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
