@include('utils.layouts.navbar.topnav')

<head>
    @yield('head')
</head>


<div class="flex justify-center h-screen pt-52 pb-64 font-rubik">
    <div class="container w-4/5">
        <div class="flex justify-between items-center px-10 py-6 bg-gray-100 mb-6 rounded-2xl">
            @auth
            <div class="">
                <p class="text-2xl text-secondary font-semibold"> Welcome back, {{ $user->us_name }}!</p>
                <p class="italic">How can we assist you today?</p>

                <div class="flex justify-between items-center py-5 bg-gray-100 mb-6 gap-3">
                    <a href=""
                        class="bg-primary hover:bg-white text-white hover:text-[#F12E52] duration-300 font-bold py-2 px-4 rounded shadow">
                        Update Profile
                    </a>
                    <a href=""
                        class="bg-primary hover:bg-white text-white hover:text-[#F12E52] duration-300 font-bold py-2 px-4 rounded shadow">
                        Exchange Request
                    </a>
                    <a href=""
                        class="bg-primary hover:bg-white text-white hover:text-[#F12E52] duration-300 font-bold py-2 px-4 rounded shadow">
                        Upload New Goods
                    </a>
                </div>
            </div>

            @else
            <div class="text-xl text-secondary">
                <h2 class="text-2xl font-semibold">Welcome to SecondLife!</h2>
                <p class="text-lg mb-5">Discover a new life for your preloved goods.</p>
                <a href="{{ route('login') }}"
                    class="bg-secondary text-white px-6 py-3 rounded-lg shadow-md hover:bg-opacity-80 transition duration-300">Login</a>
            </div>
            @endauth

            <img src="/asset/img/main-logo.png" class="h-72 mr-20" alt="SecondLife logo">
        </div>

        @include('utils.explore.swape')

        <div id="recommendationLocation">
            @include('utils.explore.recommendationLocation')
        </div>

        <br><br><br>

        <div id="trendingPrediction">
            @include('utils.explore.trendPrediction', ['products' => $products])
        </div>
        @include('utils.layouts.footer.footer')
    </div>
</div>

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script>
    // Get the wishlist count element
     const wishlistCount = document.getElementById('wishlist-count');

    // Get the wishlist from the local storage
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    // Update the wishlist count
    wishlistCount.textContent = wishlist.length;

    // Add an event listener to the remove button to update the wishlist count
    const removeButtons = document.querySelectorAll('.remove-button');
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.dataset.index;
            wishlist = wishlist.filter(item => item.index !== index);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            wishlistCount.textContent = wishlist.length;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const productCarousel = new bootstrap.Carousel(document.getElementById('productCarousel'), {
            interval: false // Disable automatic sliding
        });

        const slideRightBtn = document.querySelector('.carousel-control-next');

        slideRightBtn.addEventListener('click', function() {
            productCarousel.next(); // Slide to the next item
        });
    });
</script>