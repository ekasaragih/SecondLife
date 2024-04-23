<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .wide-popup {
            width: 1500px !important;
        }
    </style>
</head>

{{-- Filter based on categories --}}
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
        $formattedPrice = 'Rp ' . number_format($product->g_original_price, 0, ',', '.');
        @endphp

        <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image"
            data-product-image="{{ $imageUrl }}">
        <div class="px-6 py-4">
            <input type="hidden" id="goods_owner" value="{{ $product->us_ID }}" />
            <div class="font-bold text-xl mb-2">{{ $product->g_name }}</div>
            <p class="text-gray-700 text-base mb-2">{{ $product->g_desc }}
            </p>
            <div class="grid grid-cols-1 gap-2">
                <div>
                    {{-- <input type="hidden" id="goods_owner" value="{{ $product->us_ID }}" /> --}}
                    <p class="text-gray-700"><span class="font-bold">Category:</span>
                        {{ $product->g_category }}
                    </p>
                    <p class="text-gray-700"><span class="font-bold">Condition:</span>
                        {{ $product->g_type }}
                    </p>
                    <p class="text-gray-700"><span class="font-bold">Age:</span>
                        {{ $product->g_age }}
                    </p>
                    <p class="text-gray-700"><span class="font-bold">Price:</span>
                        {{$formattedPrice }}
                    </p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4">
            <div class="flex justify-between items-center">
                <button class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300"
                    id="btn_see_detail" data-product-image="{{ $imageUrl }}" data-product-name="{{ $product->g_name }}"
                    data-product-name="{{ $product->g_name }}" data-product-desc="{{ $product->g_desc }}"
                    data-product-category="{{ $product->g_category }}" data-product-category="{{ $product->g_age }}"
                    data-product-type="{{ $product->g_type }}" data-product-price="{{ $formattedPrice }}"
                    data-modal-target="modalProductDetail" data-modal-toggle="modalProductDetail">
                    View Details
                </button>
                <button
                    class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300 add-to-wishlist"
                    id="btn_add_wishlist" data-product-id="{{ $product->g_ID }}" data-user-id="{{ $user->us_ID }}">
                    Add to Wishlist
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<br><br>


{{-- Recommendation based on Categories --}}
<div class="space-y-2 space-x-2">
    <div class="text-3xl text-[#F12E52]"><b>Recommendation</b><span class="font-bold text-sm text-gray-600">based on
            your preferences</span></div>
</div>
<br>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-4">
        @php
        // Ambil daftar produk yang tidak termasuk dalam wishlist
        $nonWishlistProducts = \App\Models\Goods::all()
        ->filter(function ($product) {
        return !in_array(
        $product->id,
        collect(json_decode(request()->cookie('wishlist') ?? '[]'))
        ->pluck('id')
        ->toArray(),
        );
        })
        ->shuffle()
        ->take(8);
        @endphp

        @foreach ($nonWishlistProducts as $product)
        <div class="recommendation-card bg-gray-100 rounded-lg p-4 flex flex-col justify-between">
            <img src="{{ $product->images->first()->img_url ?? 'https://via.placeholder.com/150' }}"
                alt="{{ $product->g_name }}" class="w-full mb-2">
            <h3 class="mb-1 text-xl font-semibold">{{ $product->g_name }}</h3>
            <p class="mb-1 text-lg">Price: Rp {{ number_format($product->g_original_price, 0, ',', '.') }}</p>
            <p class="mb-4 text-lg">Category: {{ $product->g_category }}</p>
            <button
                class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300 btn-add-to-wishlist"
                data-product="{{ $product->g_ID }}" data-user-id="{{ $user->us_ID }}">
                Add to Wishlist
            </button>
        </div>
        @endforeach
    </div>
</div>

{{-- Product Details Modal --}}
@include('utils.categories.modalProductDetail')
@include('utils.categories.modalTermsAndCondition')

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
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

    $('#btn_add_wishlist').click(function(e) {
        const productId = this.getAttribute('data-product-id');
        const userId = this.getAttribute('data-user-id');

        var data = {
            g_ID: productId,
            us_ID: userId,
        }

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
                } else {
                    // Check if the error message indicates that the product is already in the wishlist
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
                // Handle errors
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var detailButtons = document.querySelectorAll('#btn_see_detail');

        detailButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var productName = this.getAttribute('data-product-name');
                var productDesc = this.getAttribute('data-product-desc');
                var productImage = this.getAttribute('data-product-image');
                var productCategory = this.getAttribute('data-product-category');
                var productType = this.getAttribute('data-product-type');
                var productPrice = this.getAttribute('data-product-price');

                document.getElementById('productName').textContent = productName;
                document.getElementById('productDesc').textContent = productDesc;
                document.getElementById('productImage').src = productImage;
                document.getElementById('productCategory').textContent = 'Category: ' + productCategory;
                document.getElementById('productType').textContent = 'Type: ' + productType;
                document.getElementById('productPrice').textContent = 'Price: ' + productPrice;

                // var modal = new fb.Modal(document.getElementById('modalProductDetail'));
                // modal.show();
            });
        });
    });


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

    const wishlistCount = document.getElementById('wishlist-count');

    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    wishlistCount.textContent = wishlist.length;

    const removeButtons = document.querySelectorAll('.remove-button');
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.dataset.index;
            wishlist = wishlist.filter(item => item.index !== index);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            wishlistCount.textContent = wishlist.length;
        });
    });

    // Function to continue to the chat page
    function continueToChat() {
        const loggedInUserId = "{{ $user->us_ID }}";
        const ownerUserId = $('#goods_owner').val();

        console.log(loggedInUserId, ownerUserId);

        window.location.href = '{{ route('home_chat') }}?logged_in_user=' + loggedInUserId + '&owner_user=' +
            ownerUserId;
    }
</script>