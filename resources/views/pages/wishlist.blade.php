@include('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">
        <div class="text-3xl text-[#F12E52]"><b>Wishlist</b></div><br>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-4">
                @foreach($wishlistItems as $wishlistItem)
                @if ($wishlistItem->goods)
                <div class="product-card bg-pink-100 rounded-lg p-4 flex flex-col justify-between">
                    @php
                    $firstImage = $wishlistItem->goods->images->first();
                    $defaultImageUrl = 'https://via.placeholder.com/400';
                    $imageUrl = $firstImage ? asset('goods_img/' . $firstImage->img_url) : $defaultImageUrl;
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $wishlistItem->goods->g_name }}"
                        class="w-full h-64 object-cover object-center mb-3">
                    <h3 class="mb-3 text-xl font-semibold">{{ $wishlistItem->goods->g_name }}</h3>
                    <h3 class="mb-1 text-base">{{ $wishlistItem->goods->g_desc }}</h3>

                    <div class="flex items-center my-5 font-medium text-sm">
                        <h3 class="mr-2 mb-1">{{ $wishlistItem->goods->g_category }}</h3>
                        <div class="h-1 w-1 bg-gray-400 rounded-full"></div>
                        <p class="ml-2 mb-1">{{ $wishlistItem->goods->g_type }}</p>
                    </div>

                    <p class="mb-1 text-lg hidden">Price Prediction: {{ $wishlistItem->goods->g_original_price }}</p>
                    <div class="px-6 py-4 mx-2 flex justify-center">
                        @auth
                        <a href="{{ route('goods_detail', ['hashed_id' => Hashids::encode($wishlistItem->goods->g_ID)]) }}"
                            class="btn-details bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition duration-300 flex-grow-0 flex-shrink-0 text-center"
                            data-product-id="{{ $wishlistItem->goods->g_ID }}"
                            data-product-user-id="{{ $wishlistItem->goods->us_ID }}"
                            data-product-name="{{ $wishlistItem->goods->g_name }}"
                            data-product-desc="{{ $wishlistItem->goods->g_desc }}"
                            data-product-category="{{ $wishlistItem->goods->g_category }}"
                            data-product-age="{{ $wishlistItem->goods->g_age }}"
                            data-product-type="{{ $wishlistItem->goods->g_type }}"
                            data-product-price="{{ $wishlistItem->goods->g_original_price }}">
                            View Details
                        </a>
                        @endauth

                        <button type="button" title="Remove from wishlist"
                            data-wishlist-id="{{ $wishlistItem->wishlist_ID }}"
                            class="bg-red-500 ml-2 text-white text-xl px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 flex-grow-0 flex-shrink-0 text-center remove-from-wishlist">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <br>

        {{-- Recommendation based on Categories --}}
        @include('utils.categories.recommendation')

        {{-- T&C Modal --}}
        @include('utils.categories.modalTermsAndCondition')

        @include('utils.layouts.footer.footer')

    </div>
</div>

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
    $(document).on('click', '.remove-from-wishlist', function() {
        var wishlistId = $(this).data('wishlist-id');
        console.log(wishlistId);
        removeFromWishlist(wishlistId);
    });

    function removeFromWishlist(wishlistId) {
        console.log("triggered");
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        $.ajax({
            url: 'api/wishlist/remove',
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Authorization': 'Bearer ' + apiToken
            },
            data: { wishlist_ID: wishlistId },
            success: function(data) {
                if (data.success) {
                    // Item removed successfully, you may want to update the UI accordingly
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
                    // Handle error response
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var detailButtons = document.querySelectorAll('#btn_see_detail');

        detailButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var productId= this.getAttribute('data-product-id');
                var productUserId= this.getAttribute('data-product-user-id');
                var productName = this.getAttribute('data-product-name');
                var productDesc = this.getAttribute('data-product-desc');
                // var productImage = this.getAttribute('data-product-image');
                var productCategory = this.getAttribute('data-product-category');
                var productType = this.getAttribute('data-product-type');
                var productPrice = this.getAttribute('data-product-price');

                document.getElementById('goodsId').textContent = productId;
                document.getElementById('productOwnerId').textContent = productUserId;
                document.getElementById('productName').textContent = productName;
                document.getElementById('productDesc').textContent = productDesc;
                // document.getElementById('productImage').src = productImage;
                document.getElementById('productCategory').textContent = 'Category: ' + productCategory;
                document.getElementById('productType').textContent = 'Type: ' + productType;
                document.getElementById('productPrice').textContent = 'Price Prediction: ' + productPrice;

            });
        });
    });

</script>