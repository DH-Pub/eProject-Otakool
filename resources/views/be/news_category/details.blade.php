@extends('be.layout.layout')
@section('title', 'News Category - Details')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">News Category Details</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                    <tr>
                                        <td>Id</td>
                                        <td>{{ $data->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>News Category</td>
                                        <td>{{ $data->news_category }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><a href="{{ route('be.edit.news.category', $data->id) }}" class="btn btn-warning">Edit</a></td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
