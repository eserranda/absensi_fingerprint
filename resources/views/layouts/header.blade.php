<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Absensi</title>
    <!-- CSS files -->
    @stack('headcss')

    <link href="{{ asset('assets') }}/dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('assets') }}/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('assets') }}/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('assets') }}/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="{{ asset('assets') }}/dist/css/demo.min.css?1692870487" rel="stylesheet" />
    <script src="{{ asset('assets') }}/dist/libs/tom-select/dist/js/tom-select.base.min.js?1692870487" defer></script>

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet"> --}}
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

<body>
    <script src="{{ asset('assets') }}/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
