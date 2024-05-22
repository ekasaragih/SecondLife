<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@include('utils.explore.modalComment')

<div class="my-5 relative">
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-[#F12E52] mb-4">Products <span class="text-sm text-gray-600">based
                on your current location</span></h2>
        <div class="flex gap-2 px-2">
        <select
    class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 mb-4"
    onchange="filterByCity(this.value)">
    <option value="Current">Current Location</option>
    <option value="All">All</option>
    @foreach($cities as $city)
        @if($city !== null)
            <option value="{{ $city }}">{{ $city }}</option>
        @endif
    @endforeach
</select>

        </div>
        <div class="product-slider-container overflow-hidden relative">
            <div class="flex" id="productCards">

                @foreach($products as $product)
                @php
                $user = $product->userID;
                $defaultImageUrl =
                'https://t3.ftcdn.net/jpg/02/48/55/64/360_F_248556444_mfV4MbFD2UnfSofsOJeA8G7pIU8Yzfqc.jpg';
                $imageUrl = isset($product->images[0]) ? asset('goods_img/' . $product->images[0]->img_url) :
                $defaultImageUrl;
                @endphp
                @if ($user && $user->us_city)
                <div class="product-card flex-none w-1/4 border border-gray-300 bg-white rounded-lg shadow-md {{ strtolower($user->us_city) }}"
                    data-location="{{ strtolower($user->us_city) }}">
                    <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-purple-600 mb-2 border-b-2 border-purple-800 pb-2"
                            style="height: 3.5rem; line-height: 1.75rem; /* Set to two lines of text */">
                            {{ $product->g_name }}
                        </h3>
                        <p class="text-sm text-gray-600 font-bold mb-1" style="height: 1.5rem; line-height: 1.5rem;">
                            Uploaded by:</p>
                        <p class="text-sm text-gray-600 mb-1" style="height: 1.5rem; line-height: 1.5rem;">{{
                            $user->us_name }}</p>
                        <p class="text-sm text-gray-600 font-bold mb-1" style="height: 1.5rem; line-height: 1.5rem;">
                            Description:</p>
                        <p class="text-sm text-gray-600 mb-1"
                            style="height: 3rem; line-height: 1.5rem; overflow: hidden;">{{ $product->g_desc }}</p>
                        <p class="text-sm text-gray-600 font-bold mb-1" style="height: 1.5rem; line-height: 1.5rem;">
                            Location:</p>
                        <p class="text-sm text-gray-600 mb-1" style="height: 1.5rem; line-height: 1.5rem;">{{
                            $user->us_city }}</p>
                        <hr class="my-4 border-b-2 border-gray-800"> <!-- Garis pembatas -->
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600 text-xs font-bold">Price Prediction: Rp {{
                                number_format($product->g_price_prediction, 0, ',', '.') }}</span>

                            @auth
                            <div>
                                <button
                                    class="bg-red-400 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300"
                                    style="font-size: 14px;"
                                    onclick="openModal('{{ $product->g_name }}', '{{ $product->g_desc }}', '{{ isset($product->images[0]) ? asset('goods_img/' . $product->images[0]->img_url) : 'https://via.placeholder.com/400' }}', '{{ $user->us_city }}', '{{ number_format($product->g_original_price, 0, ',', '.') }}', '{{ $product->g_ID }}', '{{ $user->us_username }}')">
                                    Detail
                                </button>
                            </div>
                            <div>
                                <button
                                    class="bg-red-400 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300 add-to-wishlist"
                                    style="font-size: 14px;" id="btn_add_wishlist"
                                    data-product-id="{{ $product->g_ID }}" data-user-id="{{ Auth::id() }}">
                                    Add
                                </button>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>

                @endif
                @endforeach
            </div>
        </div>

        <div class="flex justify-center no-product-message" style="display: none;">
    <div class="text-xl text-[#F12E52] mt-4 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v8a1 1 0 002 0V4a1 1 0 00-1-1zm0 12a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
        </svg>
        <span>There is no product in this location. Select another location.</span>
    </div>
</div>


        <button class="product-slider-btn left-0" onclick="slideLeft()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button class="product-slider-btn right-0" onclick="slideRight()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
    
    const productSlider = document.querySelector('.product-slider-container');
    const slideLeftBtn = document.querySelector('.product-slider-btn.left-0');
    const slideRightBtn = document.querySelector('.product-slider-btn.right-0');
    const productCards = document.querySelectorAll('.product-card');
    const cardWidth = productCards[0].offsetWidth + parseInt(getComputedStyle(productCards[0]).marginLeft) + parseInt(getComputedStyle(productCards[0]).marginRight);
    const visibleCards = 4;
    let startIndex = 0;
    let endIndex = visibleCards - 1;
    let filteredProducts = [];

    // Panggil fungsi resetIndexes saat struktur HTML lengkap dimuat
    window.addEventListener('load', resetIndexes);

    // Fungsi untuk mengatur ulang indeks awal dan akhir setelah struktur HTML lengkap dimuat
    function resetIndexes() {
        endIndex = visibleCards - 1;
        showHideCards(filteredProducts);
    }

    // Fungsi untuk menampilkan atau menyembunyikan kartu produk berdasarkan indeks
    function showHideCards(cards) {
        cards.forEach((card, index) => {
            if (index >= startIndex && index <= endIndex) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function slideLeft() {
        if (startIndex > 0) {
            startIndex--;
            endIndex--;
            productSlider.scrollLeft -= cardWidth;
            showHideCards(filteredProducts);
        }
    }

    // Fungsi untuk menggeser slide ke kanan
    function slideRight() {
        if (endIndex < {{ count($products) }} - 1) {
            startIndex++;
            endIndex++;
            productSlider.scrollLeft += cardWidth;
            showHideCards(filteredProducts);
        }
    }

    function filterByCity(location) {
    let productsFound = false; // Flag to track if any products are found

    if (location === 'Current') {
        getCurrentLocationAndFilter(); // Get and filter by current location
    } else {
        // Loop through each product card
        productCards.forEach(card => {
            const cardLocation = card.getAttribute('data-location');

            // Check if the user's location matches the selected city or "All"
            if (location === 'All' || cardLocation.toLowerCase() === location.toLowerCase()) {
                card.style.display = 'block'; // Show the product if it matches
                productsFound = true; // Set the flag to true since products are found
            } else {
                card.style.display = 'none'; // Hide the product if it doesn't match
            }
        });

        // Reset indexes for the slider
        resetIndexes();

        // If no products are found, display the message
        if (!productsFound) {
            showNoProductMessage();
        } else {
            hideNoProductMessage();
        }
    }
}

function showNoProductMessage() {
    const noProductMessage = document.querySelector('.no-product-message');
    if (noProductMessage) {
        noProductMessage.style.display = 'block';
    }
}

function hideNoProductMessage() {
    const noProductMessage = document.querySelector('.no-product-message');
    if (noProductMessage) {
        noProductMessage.style.display = 'none';
    }
}


    function getCurrentLocationAndFilter() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Use Google Maps Geocoding API to fetch the address from coordinates
                axios.get(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=AIzaSyCo37QBCTFooHIQH-Lwk-XrD6gL_uPeWVI`)
                    .then(function(response) {
                        // Log the entire API response for examination
                        console.log('Geocoding API response:', response.data);

                        // Log all address components to inspect the structure
                        const components = response.data.results[0].address_components;
                        console.log('Address Components:', components);

                        // Extract the city (locality) from available components
                        let detectedCity = null;
                        for (let component of components) {
                            // Check for potential city types (e.g., administrative_area_level_2)
                            if (component.types.includes('administrative_area_level_2')) {
                                detectedCity = component.long_name;
                                break;
                            }
                            // You can add more conditions to extract other relevant city types
                        }

                        if (detectedCity) {
                            // Log the detected city name
                            console.log('Detected City:', detectedCity);

                            // Compare with each product card's location attribute
                            productCards.forEach(card => {
                                const cardLocation = card.getAttribute('data-location');

                            // Check if the detected city matches the user's city
                            if (detectedCity.toLowerCase() === cardLocation.toLowerCase()) {
                                card.style.display = 'block'; // Show the product if it matches
                            } else {
                                card.style.display = 'none'; // Hide the product if it doesn't match
                            }
                        });
                        resetIndexes(); // Reset indexes for the slider
                    } else {
                        console.error('City (locality) not found in address components.');
                    }
                })
                .catch(function(error) {
                    console.error('Error fetching current location:', error);
                });
        });
    } else {
        console.error('Geolocation is not supported by this browser.');
    }
}
    getCurrentLocationAndFilter();
</script>