@include('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
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
                    @foreach ($wishlistItem->goods->images as $image)
                    <img src="{{ $image->img_url }}" alt="{{ $wishlistItem->goods->g_name }}" class="w-full mb-2">
                    @break {{-- To display only the first image --}}
                    @endforeach
                    <h3 class="mb-1 text-xl">{{ $wishlistItem->goods->g_name }}</h3>
                    <h3 class="mb-1 text-xl">{{ $wishlistItem->goods->g_desc }}</h3>
                    <h3 class="mb-1 text-xl">{{ $wishlistItem->goods->g_category }}</h3>
                    <p class="mb-4 text-lg">Type: {{ $wishlistItem->goods->g_type }}</p>
                    <p class="mb-1 text-lg">Price: {{ $wishlistItem->goods->g_original_price }}</p>
                    <button class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300"
                        id="btn_see_detail" data-product-id="{{ $wishlistItem->goods->g_ID }}" {{--
                        data-product-image="{{ $image->img_url }}" --}}
                        data-product-user-id="{{ $wishlistItem->goods->us_ID }}"
                        data-product-name="{{ $wishlistItem->goods->g_name }}"
                        data-product-desc="{{ $wishlistItem->goods->g_desc }}"
                        data-product-category="{{ $wishlistItem->goods->g_category }}"
                        data-product-age="{{ $wishlistItem->goods->g_age }}"
                        data-product-type="{{ $wishlistItem->goods->g_type }}"
                        data-product-price="{{ $wishlistItem->goods->g_original_price }}"
                        data-modal-target="modalProductDetail" data-modal-toggle="modalProductDetail">
                        See Details
                    </button>
                    <button
                        class="mt-2 px-4 py-2 rounded-md bg-red-600 text-white border border-transparent hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50 remove-from-wishlist"
                        data-wishlist-id="{{ $wishlistItem->wishlist_ID }}">Remove from Wishlist</button>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <br>

        {{-- Recommendation based on Categories --}}
        @include('utils.categories.recommendation')

        {{-- Product Details Modal --}}
        @include('utils.categories.modalProductDetail')

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
        removeFromWishlist(wishlistId);
    });

    function removeFromWishlist(wishlistId) {
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
                document.getElementById('productPrice').textContent = 'Price: ' + productPrice;

            });
        });
    });

</script>