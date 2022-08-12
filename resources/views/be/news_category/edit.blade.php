@extends('be.layout.layout')
@section('title', 'News Category - Edit')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">Edit News Category</h3>
                        </div>

                        <form method="POST" action="{{ route('be.update.news.category',$editData->id) }}" role="form">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Id</label>
                                    <input type="text" class="form-control" id="id" name="id" value="{{ $editData->id }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="news_category">News Category</label>
                                    <input name="news_category" class="form-control" type="text" value="{{ $editData->news_category }}">
                                    @error('news_category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('categoryErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('categoryErr') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
