@extends('fe.layout.layout')
@section('title', 'All News')

@section('style-section')
    <style>
        #news ul {
            list-style-type: none;
            padding-inline-start: 0px;
        }

        .cat-link+li {
            margin-top: 15px;
        }

        .cat-link a {
            font-weight: 400;
        }

        .cat-link a:hover {
            font-weight: 500;
        }

        .cat-link i:hover {
            color: rgb(255, 150, 13);
        }

        #news .recent-img img {
            width: 90px;
            height: 90px;
            object-fit: cover;
        }

        @media (max-width: 1199.98px) {
            #news .recent-img img {
                width: 80px;
                height: 80px;
                object-fit: cover;
            }
        }

        .news-img {
            width: 100%;
            background-color: var(--orange-color);
            border-radius: 2px;
            -webkit-transition: all .15s cubic-bezier(.4, 0, .2, 1);
            -moz-transition: all .15s cubic-bezier(.4, 0, .2, 1);
            transition: all .15s cubic-bezier(.4, 0, .2, 1);
        }

        .news-img:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            border-radius: 2px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }

        .card {
            border: none;
            background-color: var(--white-color);
        }

        .card-shadow:hover {
            box-shadow: 0 1px 18px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0 1px 18px rgba(0, 0, 0, 0.15);
            -webkit-box-shadow: 0 1px 18px rgba(0, 0, 0, 0.15);

            -webkit-transition: box-shadow 0.3s ease-in-out;
            -moz-transition: box-shadow 0.3s ease-in-out;
            transition: box-shadow 0.3s ease-in-out;
        }

        .card-body {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <section id="news">
        <div class="container">
            <div class="d-flex justify-content-center py-4">
                <h2>- What's New? -</h2>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @foreach ($news as $n)
                            <div class="col-md-4 w-50">
                                <div class="card mb-4">
                                    <div class="news-img p-1 ">
                                        <a href="{{ route('news.details', $n->id) }}"><img src="{{ url('images/news/' . $n->image) }}" class="card-img-top" alt="News Image"></a>
                                    </div>
                                    <div class="card-body card-shadow p-3">
                                        <h5 class="card-title"><a href="{{ route('news.details', $n->id) }}">{{ $n->title }}</a></h5>
                                        <small><i class="fas fa-calendar-alt"></i> {{ Carbon\Carbon::parse($n->created_at)->diffForHumans() }}</small>
                                        <p class="card-text">{!! Str::limit($n->content, 100) !!}</p>
                                        <a class="d-flex align-items-center" href="{{ route('news.details', $n->id) }}">Read more<i class="fas fa-long-arrow-alt-right ms-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div>
                            {{ $news->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3 offset-md-1">
                    <div class="">
                        <h4>Recent News</h4>
                    </div>
                    <hr>
                    <ul>
                        @foreach ($recent_news as $recent)
                            <li class="d-flex flex-row align-items-center my-4">
                                <div class="recent-img me-4">
                                    <a href="{{ route('news.details', $recent->id) }}"><img src="{{ url('images/news/' . $recent->image) }}" alt="News Image"></a>
                                </div>
                                <div class="">
                                    <h6><a href="{{ route('news.details', $recent->id) }}">{{ Str::limit($recent->title, 40) }}</a></h6>
                                    <small><i class="fas fa-calendar-alt"></i> {{ Carbon\Carbon::parse($recent->created_at)->diffForHumans() }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <br>
                    <div>
                        <div class="">
                            <h4>Categories</h4>
                        </div>
                        <hr>
                        <ul>
                            @foreach ($categories as $cat)
                                <li class="cat-link"><a class="d-flex justify-content-between align-items-center" href="{{ route('category.news', $cat->id) }}">{{ ucfirst($cat->news_category) }}<i
                                            class="fas fa-long-arrow-alt-right me-2"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
