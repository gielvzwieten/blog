<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials._head')
</head>
<body>
    <div id="app">
        @include('partials._nav')

        <main class="py-4 container">
            @include('partials._flashmessage')
            @yield('content')
            @include('partials._footer')
        </main>
    </div>
    @include('partials._javascript')

    @yield('scripts')
</body>
</html>
