<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon_io/favicon.ico') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/bb9305debb.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    @livewireStyles

    <style>
        body {
            background-image: linear-gradient(#0080bc, #24a13b);
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            color: white;
            font-family: "Montserrat", sans-serif;
            font-size: 14px;
            justify-content: center;
        }

        a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            outline: none;
            transition: all 0.2s;
        }

        a:hover,
        a:focus {
            color: #fdc654;
            transition: all 0.2s;
        }

        html {
            height: 100%;
        }

        .login-card {
            padding: 32px 32px 0;
            box-sizing: border-box;
            text-align: center;
            width: 100%;
            display: flex;
            height: 100%;
            max-height: 740px;
            max-width: 350px;
            flex-direction: column;
        }

        .login-card-content {
            flex-grow: 2;
            justify-content: center;
            display: flex;
            flex-direction: column;
        }

        .login-card-footer {
            padding: 32px 0;
        }

        h2 .highlight {
            color: #fdc654;
        }

        h2 {
            font-size: 32px;
            margin: 0;
        }

        h3 {
            color: #d61e2d;
            font-size: 14px;
            line-height: 18px;
            margin: 0;
        }

        .header {
            margin-bottom: 50px;
        }

        .logo {
            border-radius: 40px;
            width: 200px;
            height: 200px;
            display: flex;
            justify-content: center;
            margin: 0 auto 16px;
            background: rgba(255, 255, 255, 0.1);
            align-items: center;
        }

        button {
            background: white !important;
            display: block;
            color: #d61e2d;
            width: 100%;
            border: none;
            border-radius: 40px;
            padding: 12px 0;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 32px;
            outline: none;
        }

        .form-field {
            margin-bottom: 16px;
            width: 100%;
            position: relative;
        }

        .form-field .icon {
            position: absolute;
            background: white;
            color: #d61e2d;
            left: 0;
            top: 0;
            display: flex;
            align-items: center;
            height: 100%;
            width: 40px;
            height: 40px;
            justify-content: center;
            border-radius: 20px;
        }

        .form-field .icon:after {
            content: "";
            display: block;
            width: 0;
            height: 0;
            border: 12px solid transparent;
            border-left: 12px solid white;
            position: absolute;
            top: 8px;
            right: -20px;
        }

        .form-field input {
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            width: 100%;
            border-radius: 16px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            outline: none;
            transition: all 0.2s;
        }

        .form-field input::placeholder {
            color: white;
        }

        .form-field input:hover,
        .form-field input:focus {
            background: white;
            color: #d61e2d;
            transition: all 0.2s;
        }

        .form-field input:hover::placeholder {
            color: #d61e2d;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-card-content">
            <div class="header">
                <div class="logo">
                    <div><img src="{{ asset('pemda.png') }}" alt=""></div>
                </div>
                <h2>SAP<span class="highlight">TO</span></h2>
                <h3 style="color: white;">Sistem Aplikasi Pendaftaran Tera Online</h3>
            </div>
            <form method="post" action="{{ route('login') }}">
                @csrf

                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form">
                    <div class="form-field username">
                        <div class="icon">
                            <i class="fas fa-tree"></i>
                        </div>
                        <input type="text" placeholder="Email" name="email">
                    </div>
                    <div class="form-field password">
                        <div class="icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" placeholder="Password" name="password" required> <br>
                    </div>
                    <div style="margin-bottom:10px;text-align: right;">
                        <a href="{{ route('password.index') }}" class="forgot-password">Lupa Password?</a>
                    </div>

                    <button type="submit">
                        Login
                    </button>
                    <div>
                        Belum punya akun? <a href="{{ route('registrasi.index') }}">Daftar Sekarang</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-card-footer">
            {{-- <a href="">Forgot password?</a> --}}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function sweetAlert() {
            Swal.fire(
                'Berhasil!',
                'Menambahkan data.',
                'success'
            )
        }

        if ($request - > session() - > has('pesan')) {
            // alert('asu');

        }
    </script>
    @livewireScripts
    <script>
        document.getElementsByTagName("h1")[0].style.fontSize = "80px";
    </script>
    <!-- Javascript Requirements -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\LoginValidation') !!}
</body>

</html>
