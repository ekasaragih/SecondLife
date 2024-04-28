@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52 font-rubik">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52]"><b>Categories</b></div><br>

        <div id="category">
            @include('utils.categories.product')
            <div>

                <div id="recommendation">
                    @include('utils.categories.recommendation')
                </div>

                @include('utils.layouts.footer.footer')
            </div>
        </div>
    </div>
</div>