@extends('fe.layout.layout')
@section('title', 'Q&A')

@section('content')
    <section>
        <div class="container">
            <div class="faq-page">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Frequently Asked Questions</h4>
                        @php
                            $date = App\Models\QA::latest()->first();
                        @endphp
                        @if ($qas->count())
                            <span>Last Updated on {{ date('d-m-Y', strtotime($date->created_at)) }}</span>
                            @foreach ($qas as $key => $q)
                                <div class="accordion accordion-flush" id="accordionFlushExample{{ $key + 1 }}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne{{ $key + 1 }}">
                                            <button class="accordion-button collapsed shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{ $key + 1 }}"
                                                aria-expanded="false" aria-controls="flush-collapseOne{{ $key + 1 }}">
                                                <span class="border-bottom">{{ $key + 1 }}.</span> &nbsp; &nbsp;
                                                <div class="text-uppercase">{{ $q->title }}</div>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne{{ $key + 1 }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne{{ $key + 1 }}"
                                            data-bs-parent="#accordionFlushExample{{ $key + 1 }}">
                                            <div class="accordion-body">
                                                <p>{!! $q->content !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
