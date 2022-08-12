@extends('be.layout.layout')
@section('title', 'Q&A - Create')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">
                            
                        <div class="card-header">
                            <h3 class="card-title">Create a Q&A</h3>
                        </div>
                            
                        <form method="POST" action="{{ route('be.qa.postQA') }}">
                                {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input name="title" class="form-control" type="text" value="{{ old('title') }}">
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
                                    <textarea class="form-control" rows="3" name="content" placeholder="Enter details">{{ old('content') }}</textarea>
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
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection