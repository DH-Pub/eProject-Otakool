<div class="row">
    <div class="col-md-3">
        <div class="avg-container">
            <span class="avg-rating" style="--rating: {{ $c->rate }}">
                <i class="fa fa-star star"></i>
                <i class="fa fa-star star"></i>
                <i class="fa fa-star star"></i>
                <i class="fa fa-star star"></i>
                <i class="fa fa-star star"></i>
            </span>
        </div>
        <h5>{{ $c->customers->username }}</h5>
        @auth('customer')
            @if ($customer->id == $c->customers->id)
                <p class="text-muted">Your comment</p>
            @endif
        @endauth
        <small class="text-muted">
            {{ Carbon\Carbon::parse($c->created_at)->diffForHumans() }}
            @if ($c->created_at != $c->updated_at)
                <span>(edited)</span>
            @endif
        </small>
    </div>

    <div class="col-md-9 mb-5">
        <div>
            <h5>{{ $c->title }}</h5>
        </div>

        {{-- Images --}}
        @include('fe.app.product.comment.images')
        {{--  --}}

        <div>
            {{ $c->content }}
        </div>
        @auth('customer')
            @if ($customer->id == $c->customers->id)
                <button id="edit-comment" class="btn btn-warning btn-sm">
                    <i class="fas fa-pen"></i> <span>Edit</span>
                </button>
                <a class="btn btn-danger btn-sm float-right" href="{{ route('commentDelete', $c->id) }}">
                    <i class="fas fa-trash"></i> Delete
                </a>
            @endif
        @endauth
    </div>
</div>
