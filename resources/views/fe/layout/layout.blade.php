<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&display=swap" rel="stylesheet">

    {{--  --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins\bootstrap-5.1.3\css\bootstrap.min.css') }}">

    {{-- Toastr Css --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

    <link rel="stylesheet" href="{{ asset('css/fe-styles.css') }}">

    @yield('style-section')
    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body>
    @php
        $route = Route::current()->getName();
        $customer = Auth::guard('customer')->user();
    @endphp

    {{-- Page --}}
    <div class="d-flex flex-column min-vh-100">
        @include('fe.layout.header')

        {{-- Main content --}}
        <div class="content-body">
            @yield('content')
        </div>
        {{-- /Main content end --}}

        @include('fe.layout.footer')

        @if ($route != 'contact' && isset($customer))
            @include('fe.feedback.feedback')
        @endif
    </div>
    {{-- /Page end --}}

    {{-- -----------------------Script-------------------- --}}
    <script src="{{ asset('plugins/bootstrap-5.1.3/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    {{-- Toastr js --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if (Session::has('message'))
        <script>
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        </script>
    @endif

    <script src="{{ asset('js/fe-app.js') }}"></script>
    @yield('script-section')
</body>

</html>
