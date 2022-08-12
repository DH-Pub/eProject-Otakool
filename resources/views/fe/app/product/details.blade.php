@extends('fe.layout.layout')
@section('title', $p->name)

@section('style-section')
    <style>
        .choice-container {}

        .choice-container:hover {
            cursor: pointer;
            opacity: 0.4;
        }

        .product-description {
            white-space: pre-wrap;
        }

        #target {
            /* max-height: 100%; */
            width: 100%;
            object-fit: contain;
        }

        /* Zoom */
        .zoom,
        .original {
            position: relative;
        }

        /* Over purchase button */
        .viewer {
            z-index: 1;
        }

        .original {
            width: var(--details-width);
            cursor: crosshair;
            text-align: center;
            padding: 0;
        }

        .zoom .viewer,
        .zoom .viewer img,
        .zoom .magnifier {
            top: 0;
            position: absolute;
        }

        .zoom .viewer {
            left: var(--details-width);
            width: var(--details-width);
            overflow: hidden;
        }

        .magnifier {
            background-color: black;
            opacity: 0.3;
            top: 0;
            left: 0;
        }

        .magnifier,
        .viewer {
            display: none;
        }

        .original:hover~div {
            display: block;
        }

        .original::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }
    </style>
@endsection

@section('content')
    <section id="product-details" class="container">
        <div class="row w-100 p-4">
            <div class="col-xxl-5 mb-4">

                <div id="img-show" class="zoom mb-2">
                    <div class="original">
                        <img id="target" class="img-fluid" src="" alt="">
                    </div>
                    <div class="viewer">
                        <img id="view" src="" alt="">
                    </div>
                    <div class="magnifier"></div>
                </div>

                <div>
                    @if (isset($images))
                        <div class="choice-container">
                            <a href="#img-show">
                                <img src="{{ url('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}" class="img-fluid img-choice" alt="">
                            </a>
                        </div>
                        @foreach ($images as $image)
                            <div class="choice-container">
                                <a href="#img-show">
                                    <img src="{{ url('images/' . $p->type . '/' . $p->folder . '/' . $image) }}" class="img-fluid img-choice">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- left side --}}
            <div class="col-xxl-7">
                <h3>{{ $p->name }}</h3>

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
                            &nbsp;{{ $averageRating }} / 5
                        </span>
                    </div>
                @else
                    <div class="fs-6 fw-light text-muted">
                        No customer rating yet
                    </div>
                @endif


                {{-- Buy with quantity --}}
                @php
                    if ($p->type == 'figure') {
                        $max = 5;
                    } elseif ($p->type == 'manga') {
                        $max = 20;
                    } else {
                        $max = 10;
                    }
                    if ($p->quantity == 0 || $p->status == 0 || $p->status == -1) {
                        $status = 'disabled';
                    } else {
                        $status = 'active';
                    }
                    $quant = $p->quantity <= $max ? $p->quantity : $max;

                    $price = $p->price;
                @endphp

                @if ($status != 'disabled')
                    <form action="{{ route('addToCart', $p->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <select name="quantity" id="" class="my-2">
                            @for ($i = 1; $i <= $quant; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        <div class="d-grid">
                            <button type="submit" class="details product-price price-container fw-bold">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        @if (isset($priceDiscounted))
                                            <span class="text-muted text-decoration-line-through fw-normal pe-3">${{ $price }}</span>
                                            <span>${{ $priceDiscounted }}</span>

                                            @if ($promo->type == 0)
                                                <span class="discount-off">${{ $promo->amount }} off</span>
                                            @elseif ($promo->type == 1)
                                                <span class="discount-off">{{ $promo->amount }}% off</span>
                                            @endif
                                            <div class="fw-lighter">
                                                Until {{ $promo->end }}
                                            </div>
                                        @else
                                            <span class="float-left">
                                                ${{ $price }}
                                            </span>
                                        @endif
                                    </div>

                                    <span>
                                        @if ($p->release > date('Y-m-d'))
                                            Pre-order
                                        @else
                                            Buy
                                        @endif
                                    </span>
                                </div>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-muted">
                        <h2>Out of stock</h2>
                        <p>We will try to restock as soon as possible.</p>
                    </div>
                @endif
                {{-- -------------------------- --}}


                <h4>Description</h4>
                <p class="product-description">{{ $p->description }}</p>

                <h4>Release Date</h4>
                <p>{{ $p->release }}</p>
            </div>
        </div>

        @include('fe.app.product.comment.comment')

    </section>
@endsection

@section('script-section')
    <script>
        (function() {
            // zoom
            if (typeof $ !== "function")
                throw Error('JQuery is not present.');
            var times = 2,
                handler;
            var init = function() {
                var t = $(this),
                    p = t.parent(),
                    v = p.next(),
                    cs = v.next(),
                    iw = v.children();

                handler = function(e) {
                    var [w, h] = ['width', 'height'].map(x => $.fn[x].call(t)),
                        nw = w * times, nh = h * times,
                        cw = w / times, ch = h / times;
                    v.height(h);
                    var eventMap = {
                        mousemove: function(e) {
                            e = e.originalEvent;
                            var x = e.layerX,
                                y = e.layerY,
                                rx = cw / 2,
                                ry = ch / 2,
                                cx = x - rx,
                                cy = y - ry;

                            var canY = cy >= 0 && cy <= h - ch,
                                canX = cx >= 0 && cx <= w - cw;
                            cs.css({
                                top: canY ? cy : cy < 0 ? 0 : h - ch,
                                left: canX ? cx : cx < 0 ? 0 : w - cw
                            });
                            iw.css({
                                top: canY ? -cy / (h - ch) * (nh - h) : cy < 0 ? 0 : -(nh - h),
                                left: canX ? -cx / (w - cw) * (nw - w) : cx < 0 ? 0 : -(nw - w)
                            });
                        }
                    };
                    p.width(w).height(h);
                    cs.width(cw).height(ch);
                    iw.width(nw).height(nh);
                    for (let k in eventMap)
                        p.on(k, eventMap[k]);
                };
                t.on('load', handler);
            };
            $.fn.extend({
                zoom: function(t) {
                    times = t || times;
                    for (let x of this)
                        init.call(x);
                    return this;
                },
                setZoom: function(t) {
                    times = t || times;
                    if (handler === void 0)
                        throw Error('Zoom not initialized.');
                    handler();
                }
            });
        }());
    </script>

    <script>
        var l = $('#target').zoom(2.5);

        $(function() {
            $('#target').attr('src', "{{ url('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}");
            $('#view').attr('src', "{{ url('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}");

            $('.img-choice').on('click', function() {
                $('#target').attr('src', $(this).attr('src'));
                $('#view').attr('src', $(this).attr('src'));
            });

            // Comment Edit
            $('#edit-comment').click(function() {
                $('#customer-comment').hide();
                $('#edit-comment-form').show();
            });
            $('#cancel-edit-comment').click(function() {
                $('#customer-comment').show();
                $('#edit-comment-form').hide();
            })
        });
    </script>
@endsection
