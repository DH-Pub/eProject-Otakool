@extends('fe.layout.layout')
@section('title','News Details')

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
        .detail-image {
            width: 100%;
            height: 30vw;
            object-fit: scale-down;
        }

        /* .news-title {
            color: var(--orange-color);
        } */
    </style>
@endsection

@section('content')
    <section id="news">
        <div class="container">
            <div class="d-flex justify-content-center py-4">
                <!-- <h2>- News Details -</h2> -->
            </div>
            <div class="row">

                <div class="col-md-8">
                    <h2 class="news-title">{{ $news->title }}</h2>
                    <span><i class="fas fa-calendar-alt"></i> {{ Carbon\Carbon::parse($news->created_at)->diffForHumans() }}</span>
                    <div class="my-4">
                        <img src="{{ url('images/news/' . $news->image) }}" class="detail-image" alt="News Image">
                    </div>
                    <p>{!! $news->content !!}</p>
                    <div>
                        <ul>
                            <li>Share :</li>
                            <li>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter-square"></i></a>
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="col-md-3 offset-md-1">
                    <div class="">
                        <h4>Recent News</h4>
                    </div>
                    <hr>
                    <ul>
                        @foreach($recent_news as $recent)
                        <li class="d-flex flex-row align-items-center my-4">
                            <div class="recent-img me-4">
                                <a href="{{ route('news.details',$recent->id) }}"><img src="{{ url('images/news/' . $recent->image) }}" alt="News Image"></a>
                            </div>
                            <div class="">
                                <h6><a href="{{ route('news.details',$recent->id) }}">{{ Str::limit($recent->title, 40) }}</a></h6>
                                <small><i class="fas fa-calendar-alt"></i> {{ Carbon\Carbon::parse($recent->created_at)->diffForHumans() }} </small>
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
                            @foreach($categories as $cat)
                            <li class="cat-link"><a class="d-flex justify-content-between align-items-center" href="{{ route('category.news',$cat->id) }}">{{ ucfirst($cat->news_category) }}<i class="fas fa-long-arrow-alt-right me-2"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection