<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/tailwind.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/asset/img/mini-logo.png" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    @yield('head')
</head>

<div class="fixed top-0 left-0 w-full bg-white shadow-xl z-50 font-rubik">
    <div class="container mx-auto flex items-center justify-between gap-10">
        <div class="">
            <a href="/" class="header-logo">
                <img src="/asset/img/mini-logo.png" alt="SecondLife's logo" class="h-28 w-32">
            </a>
        </div>

        <div class="items-center flex-1 relative">
        <form action="{{ route('search') }}" method="GET">
    <input type="text" name="query" placeholder="Search by name..." class="p-3 border border-gray-300 rounded-lg w-full">
    <button type="submit"
        class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white text-gray-800 text-lg pr-2 rounded-md transition-colors duration-300 hover:text-pink-500">
        <ion-icon name="search-outline"></ion-icon>
    </button>
</form>
</div>

        <div class="flex items-center gap-4">
            @auth
            <a href="{{ route('wishlist') }}" title="My Wishlist"
                class="relative text-3xl text-gray-700 {{ Request::route()->getName() == 'wishlist' ? 'text-primary-content' : '' }}">
                <i class="fa fa-heart" aria-hidden="true"></i>
                <span id="wishlist-count"
                    class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                    {{ $wishlistCount }}
                </span>
            </a>

            <a href="{{ route('home_chat') }}" title="Messages"
                class="relative text-3xl text-gray-700 {{ Request::route()->getName() == 'home_chat' ? 'text-primary-content' : '' }}">
                <i class="fa fa-comments-o" aria-hidden="true"></i>
                <span
                    class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">0</span>
            </a>

            <a href="{{ route('my_profile') }}" title="My Profile"
                class="relative text-3xl text-gray-700 {{ Request::route()->getName() == 'user_profile' ? 'text-primary-content' : '' }}">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            </a>
            @else
            <a href="{{ route('login') }}" title="Sign In"
                class="relative text-base text-gray-700 hover:text-gray-600 transition-all ease-in duration-300">
                Sign In
            </a>
            @endauth


        </div>
    </div>

    @include('utils.layouts.navbar.navbarMain')
</div>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const query = document.getElementById('searchInput').value.trim();

        if (query !== '') {
            fetch(`/explore?query=${query}`, {
                method: 'GET'
            })
            .then(response => response.text())
            .then(data => {
                // Memuat hasil pencarian ke dalam container pencarian yang sesuai
                const searchContainer = document.getElementById('searchResults');
                searchContainer.innerHTML = data;
            })
            .catch(error => console.error('Error fetching search results:', error));
        }
    });
});

    
    document.addEventListener('DOMContentLoaded', function() {
                console.log($('#wishlist-count').text());
    });
</script>