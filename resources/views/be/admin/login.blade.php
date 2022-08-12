<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin login</title>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-5.1.3/css/bootstrap.min.css') }}">

    {{-- Toastr Css --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    
    <style>
        html,
        body,
        .container {
            height: 100%;
            background-color: rgb(230, 228, 228);
        }

        .my-form {
            min-width: 450px;
        }

        .form-box {
            /* border: 1px solid rgb(107, 106, 106); */
            background-color: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 2px 2px 5px 3px rgba(102, 102, 102, 0.2);
        }

        #logo {
            max-width: 400px;
        }
    </style>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center">
        <div class="form-box">
            <img src="{{ asset('images/logo/otakool.jpg') }}" alt="" class="d-block mx-auto" id="logo">
            <img src="{{ asset('images/admins/admin1.png') }}" class="mx-auto d-block" alt="">
            <form class="my-form" action="{{ Route('admin.loggedIn') }}" method="post">
                @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" />
                            <label class="form-check-label" for="remember"> Remember me </label>
                        </div>
                    </div>

                    {{-- <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div> --}}

                    @if (Route::has('password.request'))
                        {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a> --}}
                    @endif
                </div>

                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4 mx-auto d-block">Log in</button>

                <!-- Register buttons -->
                {{-- <div class="text-center">
                    <p><a href="{{ route('admin.register') }}">Register</a></p>
                </div> --}}
            </form>
        </div>
    </div>
    <div class="">

    </div>


    {{-- Scripts --}}
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
</body>

</html>
