@extends('fe.layout.layout')
@section('title', 'Otakool - Otaku\'s heaven')

@section('style-section')
    <style>
        #home-page-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            grid-auto-rows: minmax(12rem, 17rem);
        }

        #home-page-grid .grid-div {
            position: relative;

            /* hide text for overflow */
            text-overflow: ellipsis;
            /* Required text-overflow*/
            white-space: nowrap;
            overflow: hidden;
        }

        #home-page-grid h1 {
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);

            font-weight: 900;
            color: var(--white-color);
            text-shadow:
                0px -2px 0 var(--purple-color),
                2px -2px 0 var(--orange-color),
                2px 0px 0 var(--orange-color),
                2px 2px 0 var(--orange-color),
                0px 2px 0 var(--purple-color),
                -2px 2px 0 var(--purple-color),
                -2px 0px 0 var(--purple-color),
                -2px -2px 0 var(--purple-color);

            pointer-events: none;
            /* opacity: 0.9; */
        }

        #home-page-grid img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
        }

        #home-page-grid img:hover {
            opacity: 1;
        }

        .manga {
            grid-column: 1;
            grid-row: 1/3;
            border: 1px 0 0 1px var(--purple-color);
            border-radius: 2rem 0 0;
        }

        .anime {
            grid-column: 2/4;
            grid-row: 1;
            border-radius: 0 2rem 0 0;
        }

        .promotions {
            grid-column: 1;
            grid-row: 3;
        }

        .figures {
            grid-column: 2;
            grid-row: 2/4;
        }

        .merchandise {
            grid-column: 3;
            grid-row: 2/4;
        }

        .news {
            grid-column: 1/4;
            border-radius: 0 0 2rem 2rem;
        }

        .shadow-over {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            height: 0;
        }
    </style>
@endsection

@section('content')
    <section class="container">
        <div class="mb-5">
            <div id="home-page-grid">
                <div class="manga grid-div">
                    <a href="{{ route('productShow', 'manga') }}">
                        <img src="{{ asset('images/home/homepage-manga.webp') }}" alt="">
                        <span class="shadow-over"></span>
                    </a>
                    <h1>MANGA</h1>
                </div>
                <div class="anime grid-div">
                    <a href="{{ route('productShow', 'anime') }}">
                        <img src="{{ asset('images/home/homepage-anime.jpg') }}" alt="">
                    </a>
                    <h1>ANIME</h1>
                </div>
                <div class="promotions grid-div">
                    <a href="{{ route('promotion') }}">
                        <img src="{{ asset('images/home/homepage-promotions.jpg') }}" alt="">
                    </a>
                    <h1>PROMOTIONS</h1>
                </div>
                <div class="figures grid-div">
                    <a href="{{ route('productShow', 'figures') }}">
                        <img src="{{ asset('images/home/homepage-figures.jpg') }}" alt="">
                    </a>
                    <h1>FIGURES</h1>
                </div>
                <div class="merchandise grid-div">
                    <a href="{{ route('productShow', 'merchandise') }}">
                        <img src="{{ asset('images/home/homepage-merchandise.jpg') }}" alt="">
                    </a>
                    <h1>MERCHANDISE</h1>
                </div>
                <div class="news grid-div">
                    <a href="{{route('news')}}">
                        <img src="{{ asset('images/home/homepage-news.jpg') }}" alt="">
                    </a>
                    <h1>NEWS</h1>
                </div>
            </div>
        </div>

        <div>
            <h3>Latest Release</h3>
            <div class="row text-center">
                @php
                    $products = $latest;
                @endphp
                @include('fe.app.index-list')
            </div>
        </div>

        <div>
            <h3>Special Offers</h3>
            <div class="row text-center">
                @php
                    $products = $offers;
                @endphp
                @include('fe.app.index-list')
            </div>
        </div>
        {{-- <div>
            <h3>You might like</h3>

        </div> --}}
    </section>
@endsection
