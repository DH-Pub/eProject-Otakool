<style>
    .rate-star {
        direction: rtl !important;
    }

    .rate-star label {
        cursor: pointer;
    }

    .rate-star input {
        display: none;
    }

    .rate-star i {
        font-size: 1.5rem;
        color: var(--grey-color);
    }

    #create-comment.rate-star i:hover,
    #create-comment.rate-star label:hover~label i,
    .rate-star input:checked~label i {
        color: var(--purple-color);
        -webkit-text-stroke: 2px;
    }

    .image-container {
        --box-image: 9rem;
        height: var(--box-image);
        width: var(--box-image);
        object-fit: cover;
        cursor: pointer;
    }

    .image-container:hover {
        opacity: 0.7;
    }

    #edit-comment-form {
        display: none;
    }
</style>

<div class="container mt-5">
    <h3>Comment</h3>

    <hr>

    {{-- Posted comments ---------------------------------- --}}
    <div class="row">
        <div class="col-xxl-2 mb-5">
            @if ($averageRating != 0)
                <div class="avg-container">
                    <span class="avg-rating" style="--rating: {{ $averageRating }}">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                    <span class="avg-number">
                        &nbsp;{{ $averageRating }}/5
                    </span>
                </div>
                <div>
                    <p class="mb-2">
                        {{ $totalComments }}
                        @if ($totalComments <= 1)
                            review
                        @else
                            total reviews
                        @endif
                    </p>
                </div>

                @for ($i = 5; $i > 0; $i--)
                    <div class="avg-container">
                        <span class="avg-rating" style="--rating: {{ $i }}">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        <span class="avg-number">
                            &nbsp;{{ $commentRates->where('rate', $i)->count() }}
                        </span>
                    </div>
                @endfor
            @else
                <div class="col-lg fs-6 fw-light text-muted">
                    No customer rating yet
                </div>
            @endif
        </div>


        <div class="col-xl-9">
            @if (isset($customer))
                @if (!isset($custComment))
                    <form role="form" action="{{ route('comment', $p->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-3 text-end">
                                <div id="create-comment" class="form-group rate-star">
                                    @for ($i = 5; $i > 0; $i--)
                                        <input type="radio" id="{{ $i }}-star" name="rate" value="{{ $i }}">
                                        <label for="{{ $i }}-star">
                                            <i class="fa fa-star"></i>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Title of comment" name="title" maxlength="64">
                                </div>

                                {{-- Images --}}
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                                        <label class="input-group-text" for="images">Upload images</label>
                                    </div>
                                </div>
                                {{--  --}}

                                <div class="form-group mb-3">
                                    <textarea name="content" class="form-control" id="" rows="3" maxlength="510" placeholder="Comment content here"></textarea>
                                </div>

                                @error('rate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="offset-md-3 btn btn-primary py-2 px-4 mb-4">
                            Comment
                        </button>
                    </form>
                @else
                    @php
                        $c = $custComment;
                    @endphp
                    <div id="customer-comment">
                        @include('fe.app.product.comment.comments-show')
                    </div>
                    <div id="edit-comment-form">
                        @include('fe.app.product.comment.comment-edit')
                    </div>
                @endif
            @else
                <p>Please login to comment.</p>
            @endif
            <hr>

            @foreach ($comments as $c)
                @include('fe.app.product.comment.comments-show')
            @endforeach
            <span>{{ $comments->withQueryString()->links('pagination::bootstrap-5') }}</span>
        </div>
    </div>
</div>
