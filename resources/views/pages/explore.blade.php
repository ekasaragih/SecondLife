@include('utils.layouts.navbar.topnav')

<head>
    @yield('head')
</head>


<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        @auth
        @if(isset($userName))
        @if($userName === 'Admin')
        <h6>Hello, <i>{{ $userName }}!</i></h6>
        <p>Welcome to SecondLife!</p>
        @else
        <h6>Hello, <i>{{ $userName }}!</i></h6>
        <p>Welcome to Project SecondLife! Please share your stuff blabla</p>
        @endif
        @else
        <h6>Hello, User!</h6>
        <p>Welcome to Project Alchemist! Please log in.</p>
        <span><a href="{{ route('login') }}" class="btn btn-secondary">Login</a></span>
        @endif
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