<form role="form" action="{{ route('comment.edit', $c->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-3 text-end">
            <div id="create-comment" class="form-group rate-star">
                @for ($i = 5; $i > 0; $i--)
                    <input type="radio" id="{{ $i }}-star" name="rate" value="{{ $i }}" {{ $c->rate == $i ? 'checked' : '' }}>
                    <label for="{{ $i }}-star">
                        <i class="fa fa-star"></i>
                    </label>
                @endfor
            </div>
        </div>

        <div class="col-lg-8">
            <div class="form-group mb-3">
                <input type="text" class="form-control" placeholder="Title of comment" name="title" maxlength="64" value="{{ $c->title }}">
            </div>

            {{-- Images --}}
            @include('fe.app.product.comment.images')
            <div class="form-group mb-3">
                <div class="input-group">
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                    <label class="input-group-text" for="images">Upload images</label>
                </div>
            </div>
            {{--  --}}

            <div class="form-group mb-3">
                <textarea name="content" class="form-control" id="" rows="3" maxlength="510" placeholder="Comment content here">{{ $c->content }}</textarea>
            </div>

            @error('rate')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="offset-md-3">
        <button type="submit" class="btn btn-primary btn-sm">
            Save
        </button>
        <a id="cancel-edit-comment" class="btn btn-secondary btn-sm">
            <i class="fas fa-pen"></i> <span>Cancel</span>
        </a>
    </div>
</form>
