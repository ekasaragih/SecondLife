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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const items = document.querySelectorAll('[id^="carousel-item-"]');
        const indicators = document.querySelectorAll('[id^="carousel-indicator-"]');
        const prevButton = document.getElementById("data-carousel-prev");
        const nextButton = document.getElementById("data-carousel-next");
        let currentIndex = 0;

        // Function to show a specific slide
        function showSlide(index) {
            items.forEach(item => item.classList.add("hidden"));
            indicators.forEach(indicator => indicator.setAttribute("aria-current", "false"));

            items[index].classList.remove("hidden");
            indicators[index].setAttribute("aria-current", "true");
        }

        // Function to show the next slide
        function showNextSlide() {
            currentIndex = (currentIndex + 1) % items.length;
            showSlide(currentIndex);
        }

        // Function to show the previous slide
        function showPrevSlide() {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            showSlide(currentIndex);
        }

        // Add event listeners to navigation buttons
        nextButton.addEventListener("click", showNextSlide);
        prevButton.addEventListener("click", showPrevSlide);
    });
</script>