@include('utils.layouts.navbar.topnav')

<head>
    @yield('head')
</head>


<div class="flex justify-center h-screen pt-52 pb-64 font-rubik">
    <div class="container w-4/5">

        @auth
        <div class="my-4 text-secondary font-semibold">
            Olla, {{ $user->us_name }}!
        </div>
        @else
        <div class="my-4 text-secondary">
            <h6 class="text-base">Hello, User!</h6>
            <p>Welcome to Project Alchemist! Please log in.</p>
            <span><a href="{{ route('login') }}" class="text-secondary hover:text-opacity-60"><u>Login</u></a></span>
        </div>
        @endauth

        @include('utils.explore.swape')

        <div id="searchResults" class="mt-8">
            
    </div>
        
        @include('utils.explore.recommendationLocation')
        @include('utils.explore.trendPrediction', ['products' => $products])

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