@include('utils.layouts.navbar.topnav')

<head>
    @yield('head')
</head>


<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">
        @auth
        <p>Welcome, {{ $userName }}</p>
        @else
        <p>Hello!</p>
        @endauth



        @include('utils.explore.swape')
        @include('utils.explore.recommendationLocation')
    </div>
</div>

@include('utils.layouts.footer.footer')


{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script></script>