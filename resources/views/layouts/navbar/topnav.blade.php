<head>
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
</head>

<div class="container mx-auto flex justify-between items-center pb-4">
    <a href="#" class="header-logo">
        <img src="asset/img/mini-logo.png" alt="SecondLife's logo" width="120" class="mt-[-40px] mb-[-40px] mr-[-25px]">
    </a>

    <div class="header-search-container flex-1">
        <input type="search" name="search" class="search-field p-2 border border-gray-300 rounded-lg"
            placeholder="Enter your product name...">
        <button class="search-btn ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </div>

    <div class="header-user-actions">
        <button class="action-btn" title="Profile">
            <i class="fa fa-user text-secondary" aria-hidden="true"></i>
        </button>
        <button class="action-btn" title="Wishlist">
            <i class="fa fa-heart text-secondary" aria-hidden="true"></i>
            <span class="count" id="wishlist-count">0</span>
        </button>
        <button class="action-btn" title="Cart">
            <i class="fa fa-shopping-bag text-secondary" aria-hidden="true"></i>
            <span class="count" id="cart-count">0</span>
        </button>
    </div>
</div>