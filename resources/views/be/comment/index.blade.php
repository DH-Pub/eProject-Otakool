@extends('be.layout.layout')
@section('title', 'comment index')

@section('style-section')
    <style>
        .cmt-img {
            --size: 100px;
            width: var(--size);
            height: var(--size);
            object-fit: cover;
        }

        .p-img {
            --p-size: 200px;
            width: var(--p-size);
            height: var(--p-size);
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
                        <h3 class="card-title">Comments table</h3>
                    </div>

                    <div class="card-body">
                        <table id="comment" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Comment Made At</th>
                                    <th>Comment Content</th>
                                    <th>Comment for Product</th>
                                    <th>Made by User</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $c)
                                    <tr>
                                        <td>{{ $c->created_at }}</td>
                                        <td>
                                            <div>
                                                <h5>{{ $c->title }}</h5>
                                                <strong>
                                                    Rating: {{ $c->rate }}/5
                                                </strong>
                                            </div>
                                            @if (isset($c->images))
                                                @php
                                                    $images = json_decode($c->images);
                                                @endphp
                                                <div class="row">
                                                    @foreach ($images as $i)
                                                        <div class="col">
                                                            <img class="cmt-img" src="{{ url('images/comments/' . $i) }}" alt="">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                            {{ $c->content }}
                                        </td>
                                        <td>
                                            <img src="{{ url('images/' . $c->products->type . '/' . $c->products->folder . '/' . $c->products->cover) }}" alt="" class="p-img">
                                            <div>
                                                <strong>{{ $c->products->name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <p>Name: {{ $c->customers->name }}</p>
                                            <p>Username: {{ $c->customers->username }}</p>
                                            <p>Email: {{ $c->customers->email }}</p>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm float-right" href="{{ route('be.comment.delete', $c->id) }}">
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
            $('#comment').DataTable({
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
