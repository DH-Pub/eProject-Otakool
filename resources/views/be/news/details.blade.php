@extends('be.layout.layout')
@section('title', 'News - Details')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">News Details</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                    <tr>
                                        <td>Id</td>
                                        <td>{{ $data->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>News Category</td>
                                        <td>{{ $data->category->news_category }}</td>
                                    </tr>
                                    <tr>
                                        <td>News Title</td>
                                        <td>{{ $data->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>News Image</td>
                                        <td><img class="img-fluid col-md-3" src="{{ url('images/news/' . $data->image) }}" /></td>
                                    </tr>
                                    <tr>
                                        <td>News Content</td>
                                        <td>{!! $data->content !!}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><a href="{{ route('be.edit.news', $data->id) }}" class="btn btn-warning">Edit</a></td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
