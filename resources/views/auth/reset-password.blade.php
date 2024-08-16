<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Reset Password - Absensi SMAN 1 Sumarorong</title>
    <!-- CSS files -->
    <link href="{{ asset('assets') }}/dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('assets') }}/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('assets') }}/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('assets') }}/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('assets') }}/dist/css/demo.min.css?1692870487" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="./dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img
                        src="{{ asset('assets') }}/dist/img/logo-mamasa.jpg" height="60" alt=""></a>
                <a href="." class="navbar-brand navbar-brand-autodark"><img
                        src="{{ asset('assets') }}/dist/img/logo-tut-wuri.jpg" height="60" alt=""></a>
            </div>
            <form class="card card-md" action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Atur Ulang Password</h2>
                    {{-- <p class="text-secondary mb-4">Masukkan alamat email yang terdaftar untuk menerima link reset
                        password
                    </p> --}}

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="hidden" class="form-control" name="token" value="{{ request()->token }}">
                        <input type="hidden" class="form-control" id="email" name="email"
                            value="{{ request()->email }}">
                        <input class="form-control" type="password" id="password" name="password">
                    </div>

                    <div class="mb-2">
                        <label class="form-label" for="password_confirmation">Ulangi Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation">
                    </div>

                    <div class="form-footer">
                        <button class="btn btn-primary w-100" type="submit">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                <path d="M3 7l9 6l9 -6" />
                            </svg> --}}
                            Reset Password
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-center text-secondary mt-3">
                Kembali ke halaman <a href="/login">Login</a>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('assets') }}/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="{{ asset('assets') }}/dist/js/demo.min.js?1692870487" defer></script>
</body>

</html>
