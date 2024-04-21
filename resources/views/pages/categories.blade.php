@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52]"><b>Categories</b></div>


        {{-- insert code here --}}
        <br>
        @include('utils.categories.product')
        @include('utils.layouts.footer.footer')
    </div>
</div>

