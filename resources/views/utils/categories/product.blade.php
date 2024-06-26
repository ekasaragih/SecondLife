<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.js"></script>
    <style>
        #price-range {
            width: 300px;
            margin: 20px 0;
        }

        .filter-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .filter-container {
            display: flex;
            gap: 20px;
            align-items: center;
            padding: 20px 0;
        }
    </style>
</head>

{{-- Filter categories and price range --}}
<div class="filter-container">
    <select
        class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
        onchange="filterProducts()">
        <option value="All">All</option>
        @foreach ($categories as $category)
        <option value="{{ $category }}">{{ $category }}</option>
        @endforeach
    </select>


    <!-- Improved search input field for price -->
    <div class="relative">
        <input type="text" id="price-search" placeholder="Search Price" oninput="filterProducts()"
            class="py-2.5 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:border-gray-300 focus:border-blue-400 transition duration-300">
        <span class="absolute right-3 top-2.5 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM19 14l-3 3m0 0l-3-3m3 3V10"></path>
            </svg>
        </span>
    </div>

    <div id="price-range"></div>
    <span id="price-range-value" class="ml-2 text-sm font-medium text-gray-900"></span>
</div>

<!-- Notification for unavailable price -->
<div id="price-notif" class="hidden p-2 bg-red-200 text-red-800 rounded-md mt-2">The price you searched for is not
    available.</div>



<br>

{{-- Products based on categories --}}
<div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 gap-2">
    @foreach ($products as $product)
    <div class="max-w-md rounded overflow-hidden shadow-lg product-card" style="display: block; height: 550px;">
        @php
        $images = $product->images;
        $defaultImageUrl = 'https://t3.ftcdn.net/jpg/02/48/55/64/360_F_248556444_mfV4MbFD2UnfSofsOJeA8G7pIU8Yzfqc.jpg';
        $imageUrl = isset($images[0]) ? asset('goods_img/' . $images[0]->img_url) : $defaultImageUrl;
        $formattedPrice = 'Rp ' . number_format($product->g_price_prediction, 0, ',', '.');
        @endphp

        <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image"
            data-product-image="{{ $imageUrl }}">
        <div class="px-4 py-4">
            <input type="hidden" id="goods_owner" value="{{ $product->us_ID }}" />
            <div class="font-bold text-lg mb-2">{{ $product->g_name }}</div>
            <hr class="my-2 border-b-2 border-gray-800"> <!-- Garis pembatas -->
            <p class="hidden text-gray-700 text-base mb-2">{{ $product->g_desc }}
            </p>
            <div class="grid grid-cols-1 gap-2 mt-3 bg-pink-100 border border-gray-300 rounded-lg p-4">
                <div>
                    <p class="text-gray-700" style="font-size: 1em;"><span class="font-bold">Category:</span>
                        {{ $product->g_category }}
                    </p>
                    <p class=" text-gray-700"><span class="font-bold">Condition:</span>
                        {{ $product->g_type }}
                    </p>
                    <p class="text-gray-700"><span class="font-bold">Age:</span>
                        {{ $product->g_age }} <span>Years</span>
                    </p>
                    <p class=" text-gray-700"><span class="font-bold">Current Price Est.:</span>
                        {{$formattedPrice }}
                    </p>
                    <span class="hidden product-price">{{ $product->g_price_prediction }}</span>
                </div>
            </div>
        </div>
        <hr class="my-1 border-b-2 border-gray-800"> <!-- Garis pembatas -->
        <div class="px-6 py-4">
            <div class="flex justify-center items-center">
                @auth
                <a href="{{ route('goods_detail', ['hashed_id' => Hashids::encode($product->g_ID)]) }}"
                    id="btn_see_detail"
                    class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300"
                    data-product-image="{{ $imageUrl }}" data-product-id="{{ $product->g_ID }}"
                    data-product-name="{{ $product->g_name }}" data-product-user-id="{{ $product->us_ID }}"
                    data-product-desc="{{ $product->g_desc }}" data-product-category="{{ $product->g_category }}"
                    data-product-category="{{ $product->g_age }}" data-product-type="{{ $product->g_type }}"
                    data-product-price="{{ $formattedPrice }}">
                    View Details
                </a>

                <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4 add-to-wishlist duration-300 
                @if($wishlistCount > 0 && in_array($product->g_ID, $wishlistItems)) 
                    hover:text-red-500 hover:bg-red-50 hover:border hover:border-red-500 text-red-500 bg-red-50 border-red-500 
                @else 
                    hover:text-red-500 hover:bg-red-50 hover:border hover:border-red-500 
                @endif" title="Add to wishlist" id="btn_add_wishlist" data-product-id="{{ $product->g_ID }}"
                    data-user-id="{{ $user->us_ID }}">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5 love-icon" viewBox="0 0 24 24">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                        </path>
                    </svg>
                </button>
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>

<br><br>

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="/js/moment.js"></script>
<script>
    import {
            Modal
        } from 'flowbite';
</script>

<script>
    function addToWishlist(productId, userId) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        var data = {
            g_ID: productId,
            us_ID: userId,
        };

        $.ajax({
            url: 'api/wishlist/store',
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Authorization': 'Bearer ' + apiToken
            },
            data: data,
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                } else {
                    if (data.message.includes('already added')) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops...',
                            text: data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    }

    $(document).on('click', '.add-to-wishlist', function() {
        var productId = $(this).data('product-id');
        var userId = $(this).data('user-id');
        addToWishlist(productId, userId);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var slider = document.getElementById('price-range');
        var priceRangeValue = document.getElementById('price-range-value');

        // Get the maximum price prediction among products
        var maxPricePrediction = Math.max(...{!! json_encode($products->pluck('g_price_prediction')->toArray()) !!});

        noUiSlider.create(slider, {
            start: [0, maxPricePrediction],
            connect: true,
            range: {
                'min': 0,
                'max': maxPricePrediction
            },
            step: 5000,
            format: {
                to: function (value) {
                    return 'Rp ' + value.toLocaleString();
                },
                from: function (value) {
                    return Number(value.replace('Rp ', '').replace(/,/g, ''));
                }
            }
        });

        slider.noUiSlider.on('update', function (values, handle) {
            priceRangeValue.innerHTML = values.join(' - ');
            filterProducts();
        });
    });

    function filterProducts() {
    const category = document.querySelector('select').value;
    const slider = document.getElementById('price-range').noUiSlider;
    const [minPrice, maxPrice] = slider.get().map(value => parseFloat(value.replace('Rp ', '').replace(/,/g, '')));

    // Get the price search input value
    const priceSearch = parseFloat(document.getElementById('price-search').value.trim());

    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        const productCategoryElement = card.querySelector('p:nth-child(1)');
        const productPriceElement = card.querySelector('.product-price');

        if (productCategoryElement) {
            const productCategoryText = productCategoryElement.textContent.trim();
            const categoryIndex = productCategoryText.indexOf('Category:');
            let shouldDisplay = false;

            if (categoryIndex !== -1) {
                const productCategory = productCategoryText.slice(categoryIndex + 'Category:'.length).trim();
                const isCategoryMatch = (category === 'All' || productCategory.toLowerCase() === category.toLowerCase());
                
                // Check if the product has a price prediction
                if (productPriceElement) {
                    const productPricePrediction = parseFloat(productPriceElement.textContent.trim().replace('Rp ', '').replace('.', '').replace(',', ''));
                    // If the price search value is not NaN and matches the product's price prediction, display the product
                    shouldDisplay = ((isNaN(priceSearch) || productPricePrediction === priceSearch) && isCategoryMatch && productPricePrediction >= minPrice && productPricePrediction <= maxPrice);
                } else {
                    // If the product does not have a price prediction, only display if it matches the category
                    shouldDisplay = isCategoryMatch;
                }
            }

            // Apply display style based on the shouldDisplay flag
            card.style.display = shouldDisplay ? 'block' : 'none';
        }
    });
}
    
</script>