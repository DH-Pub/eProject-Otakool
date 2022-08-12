@extends('be.layout.layout')
@section('title', 'News - Edit')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">Create News</h3>
                        </div>

                        <form method="POST" action="{{ route('be.update.news', $editData->id) }}" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Id</label>
                                    <input type="text" class="form-control" id="id" name="id" value="{{ $editData->id }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="news_category_id">News Category<small style="font-weight:normal">(Open this select menu)</small></label>
                                    <select name="news_category_id" class="form-control">
                                        <option selected=""></option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $editData->news_category_id ? 'selected' : '' }}>{{ $cat->news_category }}</option> 
                                        @endforeach
                                    </select>
                                    @error('news_category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">News Title</label>
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
                                    <label for="content">News Content</label>
                                    <textarea id="editor" class="form-control" rows="3" name="content" placeholder="Enter details">{{ $editData->content }}</textarea>
                                    @error('content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('contentErr'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('contentErr') }}
                                    </div>
                                    @endif                               
                                </div>

                                <div class="form-group">
                                    <label for="image">News Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <label for="image" class="custom-file-label">Choose a news image</label>
                                            <input type="file" id="image" name="image">
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
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

@section('script-section')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });

        //ckeditor
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            })
            .catch( error => {
                    console.error( error );
            });
    </script>

@endsection
