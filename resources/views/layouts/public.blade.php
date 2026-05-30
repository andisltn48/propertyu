<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'PropertyU'))</title>
    <meta name="description" content="@yield('description', 'PropertyU — Visionary Living Redefined')">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    <meta name="robots" content="@yield('robots', 'index, follow')">

    <meta property="og:title" content="@yield('og_title', config('app.name', 'PropertyU'))">
    <meta property="og:description" content="@yield('og_description', 'PropertyU — Visionary Living Redefined')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('og-default.png'))">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name', 'PropertyU') }}">
    <meta property="og:locale" content="id_ID">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', config('app.name', 'PropertyU'))">
    <meta name="twitter:description" content="@yield('og_description', 'PropertyU — Visionary Living Redefined')">
    <meta name="twitter:image" content="@yield('og_image', asset('og-default.png'))">

    @yield('jsonld')

    @stack('head')
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>
