@extends('be.layout.layout')
@section('title', 'feedback index')

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
                        <h3 class="card-title">Feedback table</h3>
                    </div>

                    <div class="card-body">
                        <table id="feedback" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Feedback Made At</th>
                                    <th>Feedback Title</th>
                                    <th>Feedback Content</th>
                                    <th>Made by User</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedbacks as $f)
                                    <tr>
                                        <td>{{ $f->created_at }}</td>
                                        <td>{{ $f->title }}</td>
                                        <td>{{ $f->content }}</td>
                                        <td>
                                            <p>Name: {{ $f->customers->name }}</p>
                                            <p>Username: {{ $f->customers->username }}</p>
                                            <p>Email: {{ $f->customers->email }}</p>
                                        </td>
                                        <td>
                                            @if ($f->status == '0')
                                                <span class="btn btn-primary btn-sm">Open</span>
                                            @elseif($f->status == '1')
                                                <span class="btn btn-secondary btn-sm">Closed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($f->status == '0')
                                                <a href="{{ route('approval.feedback', $f->id) }}" class="btn btn-info  btn-sm">Approve</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Feedback Made At</th>
                                    <th>Feedback Title</th>
                                    <th>Feedback Content</th>
                                    <th>Made by User</th>
                                    <th>Status</th>
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
            $('#feedback').DataTable({
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
