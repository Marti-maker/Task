<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<header>
    @include('partials.navbar')
</header>
<body>
<div id="app">
    @yield('content')
</div>

</body>
<footer class="text-center text-lg-start bg-light text-muted">
    @include('partials.footer')
</footer>
</html>

