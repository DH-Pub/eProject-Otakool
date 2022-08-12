@if (isset($c->images))
    @php
        $images = json_decode($c->images);
        $slide = 0;
    @endphp
    <div class="row row-cols-auto" data-bs-toggle="modal" data-bs-target="#modalImg{{ $c->id }}">
        @foreach ($images as $i)
            <div class="col">
                <img src="{{ url('images/comments/' . $i) }}" alt="" class="image-container" data-bs-target="#caraouselControls{{ $c->id }}" data-bs-slide-to="{{ $slide++ }}">
            </div>
        @endforeach
    </div>


    {{-- Modal --}}
    <div class="modal fade" id="modalImg{{ $c->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="caraouselControls{{ $c->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $key => $i)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ url('images/comments/' . $i) }}">
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#caraouselControls{{ $c->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#caraouselControls{{ $c->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif
