<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/tailwind.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">

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
                <input type="text" name="query" placeholder="Search by name..."
                    class="p-3 border border-gray-300 rounded-lg w-full">
                <button type="submit"
                    class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white text-gray-800 text-lg pr-2 rounded-md transition-colors duration-300 hover:text-pink-500">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </form>
        </div>

        <div class="flex items-center gap-4 relative">
            @auth
            <div class="relative">
                <a href="{{ route('wishlist') }}" title="My Wishlist"
                    class="text-3xl text-gray-700 {{ Request::route()->getName() == 'wishlist' ? 'text-primary-content' : '' }}">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </a>
            </div>

            <a href="{{ route('home_chat') }}" title="Messages"
                class="relative text-3xl text-gray-700 {{ Request::route()->getName() == 'home_chat' ? 'text-primary-content' : '' }}">
                <i class="fa fa-comments-o" aria-hidden="true"></i>
            </a>

            <a href="{{ route('my_profile') }}" title="My Profile"
                class="relative text-3xl text-gray-700 {{ Request::route()->getName() == 'user_profile' ? 'text-primary-content' : '' }}"
                style="padding-right: 20px;">
                @if (Auth::user()->avatar)
                <img class="p-0 w-10 h-10 rounded-full" src="{{ asset('users_img/' . Auth::user()->avatar) }}"
                    alt="User Avatar" />
                @else
                <i class="fa fa-user-circle" aria-hidden="true"></i>
                @endif
            </a>
            <ul
                class="absolute top-full right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-10 hidden w-36">
                <!-- Mengurangi lebar menjadi w-36 -->
                <li><a href="{{ route('wishlist') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My
                        Wishlist</a></li>
                <li><a href="{{ route('home_chat', ['logged_in_user' => Auth::id()]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Messages</a></li>
                <li><a href="{{ route('my_profile') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </li>
            </ul>

            @else
            <a href="{{ route('login') }}" title="Sign In"
                class="text-base text-gray-700 hover:text-purple-600 hover:underline hover:text-xl transition-all ease-in duration-150">Login</a>
            @endauth
        </div>
    </div>

    @include('utils.layouts.navbar.navbarMain')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileLink = document.querySelector('[title="My Profile"]');
        const profileDropdown = profileLink.nextElementSibling;
        let timeout;

        profileLink.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
            profileDropdown.classList.remove('hidden');
        });

        profileLink.addEventListener('mouseleave', function() {
            timeout = setTimeout(function() {
                profileDropdown.classList.add('hidden');
            }, 200);
        });

        profileDropdown.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
        });

        profileDropdown.addEventListener('mouseleave', function() {
            profileDropdown.classList.add('hidden');
        });
    });
</script>