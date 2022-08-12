@extends('fe.layout.layout')
@section('title','Otakool - Otaku\'s heaven')

@section('content')
    <section>
        <div class="container" >
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 pt-2" id="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22106.977703065208!2d106.69665266759439!3d10.788067146361577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f385570472f%3A0x1787491df0ed8d6a!2sIndependence%20Palace!5e0!3m2!1sen!2s!4v1657278071618!5m2!1sen!2s" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    
                        <div class="d-flex justify-content-center">
                            <div class="col-md-9 py-5 contact-form">
                                <form method="POST" action="{{ route('customer.postContact') }}">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="mb-5 text-center">
                                            <h2 class="title">Any questions? Feel free to contact</h2>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control" 
                                                placeholder="Enter your name*"value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <input type="email" name="email" class="form-control" 
                                                placeholder="Enter your email*"value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text" name="title" class="form-control" 
                                                placeholder="Enter your title*"value="{{ old('title') }}">
                                                @error('title')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>

                                        <div>
                                            <textarea name="content" class="form-control mt-5" placeholder="Enter your message*"></textarea>
                                            @error('content')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>  
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn gradient-btn mt-5">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection