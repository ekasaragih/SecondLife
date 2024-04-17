@include('utils.layouts.navbar.topnav')

<head>
    @yield('head')
</head>


<div class="flex justify-center h-screen pt-52 pb-64">
    <div class="container w-4/5">
        @include('utils.explore.swape')
        @include('utils.explore.recommendationLocation')

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
</script>