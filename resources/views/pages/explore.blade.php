@include('utils.layouts.navbar.topnav')

<head>
    @yield('head')
</head>


<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">
        {{-- <h2>Welcome, {{ auth()->user()->us_name }}!</h2> --}}
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