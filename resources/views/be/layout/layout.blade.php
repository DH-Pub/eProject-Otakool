<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    {{-- Plugins --}}
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/be-styles.css') }}">

    {{-- Toastr Css --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

    @yield('style-section')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('be.layout.header')
        @include('be.layout.sidebar')

        {{-- main content --}}
        <div class="content-wrapper">
            @yield('content')
        </div>
        {{-- end content --}}

        @include('be.layout.footer')
    </div>

    {{-- ----------------Script-------------- --}}
    {{-- Plugins --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.bundle.min.js') }}"></script>
    {{-- AdminLTE --}}
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>


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

    {{-- ckeditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

    <script src="{{ asset('js/be-app.js') }}"></script>
    @yield('script-section')
</body>

</html>
