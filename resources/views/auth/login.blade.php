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
    <title>Login - Sistem Absensi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <script src="{{ asset('assets') }}/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="." class="navbar-brand navbar-brand-autodark"><img
                                    src="{{ asset('assets') }}/dist/img/logo-mamasa.jpg" height="60"
                                    alt=""></a>
                            <a href="." class="navbar-brand navbar-brand-autodark"><img
                                    src="{{ asset('assets') }}/dist/img/logo-tut-wuri.jpg" height="60"
                                    alt=""></a>
                        </div>
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4">Login </h2>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Email Or NUPTK</label>
                                        <input id="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" autocomplete="use rname" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="input-group input-group-flat">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </form>


                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <h1 class="text-center">ABSENSI SMAN 1 SUMARORONG</h1>
                    <img src="{{ asset('assets') }}/dist/img/sekolah.jpg" height="300" width="400"
                        class="d-block mx-auto" alt="">
                    {{-- <img src="{{ asset('assets') }}/dist/img/logo-mamasa.jpg" height="300" class="d-block mx-auto"
                        alt=""> --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("form_login").addEventListener("submit", function(event) {
                event.preventDefault();

                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                fetch("/login", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            email,
                            password
                        })
                    })
                    .then(response => response.json())

                    .then(data => {
                        if (!data.success) {
                            if (data.errors) {
                                errorMessagesElement.innerHTML = ''; // kosongkan alert sebelumnya
                                Object.values(data.errors).forEach(errors => {
                                    errors.forEach(error => {
                                        const errorMessage = document.createElement(
                                            'div');
                                        errorMessage.textContent = error;
                                        errorMessagesElement.appendChild(errorMessage);
                                    });
                                });
                                alertElement.style.display = 'block';
                            }
                        } else {
                            console.log("Login Sukses");
                            window.location.href = data.redirect;
                        }
                    })
                    .catch(error => console.error('Error submitting form:', error));
            });
        });
    </script>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('assets') }}/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="{{ asset('assets') }}/dist/js/demo.min.js?1692870487" defer></script>
</body>

</html>
