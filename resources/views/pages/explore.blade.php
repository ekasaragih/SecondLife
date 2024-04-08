@include('layouts.navbar.topnav')

@section('head')
@endsection

<div class="flex justify-center h-screen mt-10">
    <div class="container w-4/5">
        @include('pages.swape')
        @include('pages.recommendation_location')
    </div>
</div>

{{-- @include('layouts.footer.footer') --}}

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script></script>