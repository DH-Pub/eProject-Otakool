@extends('be.layout.layout')
@section('title', 'Product Update')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update {{ $p->name }}</h3>
                        </div>

                        {{-- FORM --}}
                        <form role="form" action="{{ Route('be.product.postUpdate', $p->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id">Id</label>
                                    <input type="text" class="form-control" id="id" name="id" value="{{ $p->id }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Input Product Name" value="{{ $p->name }}">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('nameErr'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('nameErr') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step=".01" class="form-control" id="price" name="price" placeholder="Input Product Price" value="{{ $p->price }}">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="9" name="description" placeholder="Enter description">{{ $p->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="release">Release</label>
                                    <input type="date" class="form-control" id="release" name="release" placeholder="Input Release Date" value="{{ $p->release }}">
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Input Product Quantity" value="{{ $p->quantity }}">
                                    @error('quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <div>
                                        <label class="radio-inline px-2"><input type="radio" name="status" value="1" {{ $p->status == '1' ? 'checked' : '' }}>Available</label>
                                        <label class="radio-inline px-2"><input type="radio" name="status" value="0" {{ $p->status == '0' ? 'checked' : '' }}>Out of stock</label>
                                        <label class="radio-inline px-2"><input type="radio" name="status" value="-1" {{ $p->status == '-1' ? 'checked' : '' }}>Hidden</label>
                                    </div>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control" aria-label="Default select example">
                                        <option value="manga" {{ $p->type == 'manga' ? 'selected' : '' }}>Manga</option>
                                        <option value="anime-disc" {{ $p->type == 'anime-disc' ? 'selected' : '' }}>Anime Disc</option>
                                        <option value="figure" {{ $p->type == 'figure' ? 'selected' : '' }}>Figure</option>
                                        <option value="merchandise" {{ $p->type == 'merchandise' ? 'selected' : '' }}>Merchandise</option>
                                    </select>

                                    @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" class="form-control" id="tags" name="tags" placeholder="#Bleach,#shounen,#action, ..." value="{{ $p->tags }}">
                                </div>

                                <div class="form-group">
                                    <label for="cover">Cover</label>
                                    <div>
                                        <img src="{{ url('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}" class="img-fluid">
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="cover" name="cover">
                                            <label for="cover" class="custom-file-label">Choose a cover image</label>
                                        </div>
                                    </div>
                                    @error('cover')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @if (Session::has('err'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('err') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="images">Other Images</label>
                                    <div class="row">
                                        @if (isset($images))
                                            @foreach ($images as $image)
                                                <img src="{{ url('images/' . $p->type . '/' . $p->folder . '/' . $image) }}" class="img-fluid col-md-3">
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file" id="images-upload">
                                            <input type="file" id="images" name="images[]" multiple>
                                            <label for="images" class="custom-file-label">Choose multiple images (Cover is required)</label>
                                        </div>
                                    </div>
                                    @error('images.*')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="folder">Stored Folder</label>
                                    <input type="text" class="form-control" id="folder" name="folder" placeholder="Choose folder to store" value="{{ $p->folder }}">
                                    @error('folder')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                        {{-- END FORM --}}
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
    </script>
@endsection
