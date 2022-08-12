@if (isset($products))
    @foreach ($products as $p)
        <div class="col-lg-2 col-md-3">
            <div class="p-1">
                <a href="{{ route('details', $p->id) }}" class="link-dark">
                    <div class="product-thumbnail">
                        <img src="{{ url('images/' . $p->type . '/' . $p->folder . '/' . $p->cover) }}" class="img-fluid" alt="">
                    </div>
                    <div class="p-1">
                        <div>
                            <strong>{{ $p->name }}</strong>
                        </div>

                        <div>
                            @php
                                foreach ($promotions as $promo) {
                                    if (str_contains($promo->applied_products, $p->id)) {
                                        $amount = $promo->amount;
                                        break;
                                    } else {
                                        $amount = null;
                                    }
                                }
                            @endphp
                            <div class="price-container">
                                @if (isset($amount))
                                    @php
                                        if ($promo->type == 0) {
                                            $price = $p->price - $amount;
                                        } elseif ($promo->type == 1) {
                                            $price = $p->price * (1 - $amount / 100);
                                        }
                                        $price = round($price, 2);
                                    @endphp
                                    <p class="product-price text-start">
                                        <span class="text-muted text-decoration-line-through fw-normal pe-3">${{ $p->price }}</span>
                                        ${{ $price }}
                                    </p>


                                    @if ($promo->type == 0)
                                        <span class="discount-off">${{ $amount }} off</span>
                                    @elseif ($promo->type == 1)
                                        <span class="discount-off">{{ $amount }}% off</span>
                                    @endif
                                @else
                                    <p class="product-price">${{ $p->price }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="list-card">
                            @if ($p->averageRating != null)
                                @php
                                    $avg = round($p->averageRating, 1);
                                @endphp
                                <div class="avg-container">
                                    <span class="avg-rating" style="--rating: {{ $avg }}">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="avg-number">
                                        {{ $avg }} / 5
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
@endif
