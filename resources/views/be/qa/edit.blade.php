@extends('be.layout.layout')
@section('title', 'Q&A - Edit')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">Edit Q&A</h3>
                        </div>

                        <form method="POST" action="{{ route('be.update.qa', $editData->id) }}">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Id</label>
                                    <input type="text" class="form-control" id="id" name="id" value="{{ $editData->id }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input name="title" class="form-control" type="text" value="{{ $editData->title }}">
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('titleErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('titleErr') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" rows="3" name="content" placeholder="Enter details">{{ $editData->content }}</textarea>
                                    @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('contentErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('contentErr') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection