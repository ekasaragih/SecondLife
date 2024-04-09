<head>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
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

<div class="fixed top-0 left-0 w-full bg-white shadow-xl z-50">
    <div class="container mx-auto flex items-center justify-between gap-10">
        <div class="">
            <a href="/" class="header-logo">
                <img src="asset/img/mini-logo.png" alt="SecondLife's logo" class="h-28 w-32">
            </a>
        </div>

        <div class="items-center flex-1 relative">
            <input type="search" name="search" class="p-3 border border-gray-300 rounded-lg w-full"
                placeholder="Find product here..">
            <button
                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white text-gray-800 text-lg pr-2 rounded-md transition-colors duration-300 hover:text-pink-500">
                <ion-icon name="search-outline"></ion-icon>
            </button>
        </div>

        <div class="flex items-center gap-4">

            <button class="relative text-3xl text-gray-700" title="Wishlist">
                <i class="fa fa-heart" aria-hidden="true"></i>
                <span
                    class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">0</span>
            </button>

            <button class="relative text-3xl text-gray-700" title="Cart">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                <span
                    class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">0</span>
            </button>

            <button class="relative text-3xl text-gray-700" title="Messages">
                <i class="fa fa-comments-o" aria-hidden="true"></i>
                <span
                    class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded-full">0</span>
            </button>

            <button class="relative text-3xl text-gray-700" title="My Profile">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    @include('layouts.navbar.navbar-main')
</div>