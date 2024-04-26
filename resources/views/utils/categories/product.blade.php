<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

{{-- Filter categories --}}
<div class="flex gap-2 px-2">
    <select
        class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
        onchange="filterByCategory(this.value)">
        <option value="All">All</option>
        @foreach ($categories as $category)
        <option value="{{ $category }}">{{ $category }}</option>
        @endforeach
    </select>
</div>

<br>

{{-- Products based on categories --}}
<div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 gap-2">
    @foreach ($products as $product)
    <div class="max-w-md rounded overflow-hidden shadow-lg product-card" style="display: block; height: 550px;">
        @php
        $images = $product->images;
        $defaultImageUrl =
        'https://cdn.eraspace.com/media/catalog/product/i/p/ipad_gen_10_10_9_inci_wi-fi_cellular_pink_1.jpg';
        $imageUrl = isset($images[0]) ? $images[0]->img_url : $defaultImageUrl;
        $formattedPrice = 'Rp ' . number_format($product->g_price_prediction, 0, ',', '.');
        @endphp

        <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image"
            data-product-image="{{ $imageUrl }}">
        <div class="px-6 py-4">
            <input type="hidden" id="goods_owner" value="{{ $product->us_ID }}" />
            <div class="font-bold text-xl mb-2">{{ $product->g_name }}</div>
            <p class="hidden text-gray-700 text-base mb-2">{{ $product->g_desc }}
            </p>
            <div class="grid grid-cols-1 gap-2 mt-3">
                <div>
                    <p class="text-gray-700"><span class="font-bold">Category:</span>
                        {{ $product->g_category }}
                    </p>
                    <p class="hidden text-gray-700"><span class="font-bold">Condition:</span>
                        {{ $product->g_type }}
                    </p>
                    <p class="text-gray-700"><span class="font-bold">Age:</span>
                        {{ $product->g_age }} <span>Years</span>
                    </p>
                    <p class="hidden text-gray-700"><span class="font-bold">Prediction price:</span>
                        {{$formattedPrice }}
                    </p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4">
            <div class="flex justify-between items-center">
                @auth
                <a href="{{ route('goods_detail', ['id' => $product->g_ID]) }}" id="btn_see_detail"
                    class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300"
                    data-product-image="{{ $imageUrl }}" data-product-id="{{ $product->g_ID }}"
                    data-product-name="{{ $product->g_name }}" data-product-user-id="{{ $product->us_ID }}"
                    data-product-desc="{{ $product->g_desc }}" data-product-category="{{ $product->g_category }}"
                    data-product-category="{{ $product->g_age }}" data-product-type="{{ $product->g_type }}"
                    data-product-price="{{ $formattedPrice }}">
                    View Details
                </a>

                <button
                    class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300 add-to-wishlist"
                    id="btn_add_wishlist" data-product-id="{{ $product->g_ID }}" data-user-id="{{ $user->us_ID }}">
                    Add to Wishlist
                </button>
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>

<br><br>


{{-- Recommendation based on Categories --}}
@include('utils.categories.recommendation')

@auth
{{-- T&C Modal --}}
@include('utils.categories.modalTermsAndCondition')
@endauth

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
    // Filter by Category
    function filterByCategory(category) {
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            const productCategoryElement = card.querySelector('p:nth-child(1)');
            if (productCategoryElement) {
                const productCategoryText = productCategoryElement.textContent.trim();
                const categoryIndex = productCategoryText.indexOf('Category:');
                if (categoryIndex !== -1) {
                    const productCategory = productCategoryText.slice(categoryIndex + 'Category:'.length)
                .trim();
                    if (category === 'All' || productCategory.toLowerCase() === category.toLowerCase()) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            }
        });
    }


</script>