@include('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="flex justify-center h-screen pt-48 pb-64 font-rubik">
    <div class="container w-4/5">
        <div class="text-3xl text-[#F12E52]"><b>Product Detail</b></div>

        <section class="text-gray-700 body-font overflow-hidden bg-white">
            <div class="my-10 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <div id="productImages" class="lg:w-1/2 w-full flex justify-center items-center">
                        <div class="flex items-center">
                            @foreach ($product->images as $image)
                            <img class="product-image hidden h-64 object-cover object-center"
                                src="{{ asset('goods_img/' . $image->img_url) }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">SECONDLIFE BARTER</h2>
                        <h1 class="text-primary text-3xl title-font mb-1 font-semibold">{{ $product->g_name }}</h1>
                        <p class="leading-relaxed hidden" id="productOwnerId">{{ $product->us_ID }}</p>
                        <p class="leading-relaxed text-gray-600">{{ $product->g_desc }}</p>
                        <div class="flex items-center my-5 pb-5 font-medium text-sm border-b-2 border-primary-content">
                            <h3 class="mr-2">{{ $product->g_category }}</h3>
                            <div class="h-1 w-1 bg-primary-content rounded-full"></div>
                            <p class="ml-2">{{ $product->g_type }}</p>
                        </div>

                        <div class="flex flex-col justify-center items-center">
                            <div class="text-center mb-4">
                                <span class="title-font font-medium text-xl text-gray-900">
                                    Prediction price:
                                </span>
                                <span class="text-base">

                                    Rp{{ number_format($product->g_price_prediction, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex">
                                <button
                                    class="text-white bg-red-500 border-0 py-2 px-2 text-sm focus:outline-none disabled:bg-slate-400 hover:bg-red-600 rounded transition duration-300"
                                    data-modal-target="modalTermsAndCondition" @if ($product->us_ID === auth()->id())
                                    data-popover-target="popoverDisabled" @endif
                                    data-modal-toggle="modalTermsAndCondition"
                                    {{ $product->us_ID === auth()->id() ? 'disabled' : '' }}>
                                    Click to Barter
                                </button>
                                &nbsp;&nbsp;&nbsp;&nbsp;

                                <div data-popover id="popoverDisabled" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Why i can't click this?
                                        </h3>
                                    </div>
                                    <div class="px-3 py-2">
                                        <p>This is your own goods. You can't barter with your own goods.</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>

                                <button
                                    class="text-white bg-red-500 border-0 py-2 px-2 text-sm focus:outline-none hover:bg-red-600 rounded transition duration-300"
                                    data-modal-target="productModal"
                                    onclick="openModal('{{ rawurlencode($product->g_name) }}', '{{ rawurlencode($product->g_desc) }}', '{{ isset($product->images[0]) ? asset('goods_img/' . rawurlencode($product->images[0]->img_url)) : 'https://via.placeholder.com/400' }}', '{{ rawurlencode($user->us_city) }}', '{{ rawurlencode(number_format($product->g_price_prediction, 0, ',', '.')) }}', '{{ rawurlencode($product->g_ID) }}', '{{ rawurlencode($userDetails->us_username) }}')">
                                    View Comment
                                </button>

                                <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4 add-to-wishlist duration-300 
                                @if ($wishlistCount > 0 && $wishlistItems->contains('g_ID', $product->g_ID)) hover:text-red-500 hover:bg-red-50 hover:border hover:border-red-500 text-red-500 bg-red-50 border-red-500 
                                @else 
                                    hover:text-red-500 hover:bg-red-50 hover:border hover:border-red-500 @endif"
                                    title="Add to wishlist" id="btn_add_wishlist" data-product-id="{{ $product->g_ID }}"
                                    data-user-id="{{ $authenticatedUser->us_ID }}">
                                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" class="w-5 h-5 love-icon" viewBox="0 0 24 24">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                                        </path>
                                    </svg>
                                </button>

                                <!-- Modal Comment Component -->
                                @include('utils.explore.modalComment')
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('goods.wishlisted.users', ['hashed_id' => Hashids::encode($product->g_ID)]) }}"
                        class="text-white bg-blue-500 border-0 py-2 px-2 text-sm focus:outline-none hover:bg-blue-600 rounded transition duration-300">
                        View Users Who Wishlisted This Item
                    </a>
                </div>
            </div>
            <div class="mt-4">
                <span class="mr-3 text-gray-500">Uploaded by:</span>
                <a href="{{ route('userProfile', ['username' => $userDetails->us_username]) }}"
                    class="font-semibold text-fray-400">{{ $userDetails->us_name }}</a><br>
                <span class="text-gray-500">Located in <strong class="text-black font-bold">{{ $userDetails->us_city
                        }}</strong></span>
            </div>

            @if ($wishlistCount > 0 && $wishlistItems->contains('g_ID', $product->g_ID))
            @php
            $messageDisplayed = false;
            @endphp

            <div class="flex flex-wrap">
                @foreach ($wishlist as $wishcheck)
                @foreach ($myGoods as $mygood)
                @if ($wishcheck->us_ID == $userDetails->us_ID && $wishcheck->g_ID == $mygood->g_ID)
                @if (!$messageDisplayed)
                <div class="text-2xl mt-8 mb-4 text-[#F12E52] flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#F12E52] mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18.293 5.293a1 1 0 00-1.414-1.414L8 13.586l-3.293-3.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l10-10z"
                            clip-rule="evenodd" />
                    </svg>
                    <b>Matched!</b>
                    <span class="font-bold text-sm text-gray-600 mx-4">{{ $userDetails->us_name }} also wishlisted your
                        goods!</span>
                </div>
                @php
                $messageDisplayed = true;
                @endphp
                @endif

                @break
                @endif
                @endforeach
                @endforeach

                {{-- Menampilkan daftar barang yang cocok --}}
                @foreach ($wishlist as $wishcheck)
                @foreach ($myGoods as $mygood)
                @if ($wishcheck->us_ID == $userDetails->us_ID && $wishcheck->g_ID == $mygood->g_ID)
                <div class="max-w-md rounded overflow-hidden shadow-lg product-card flex flex-col mr-4 mb-4">
                    @php
                    $images = $mygood->images;
                    $defaultImageUrl =
                    'https://t3.ftcdn.net/jpg/02/48/55/64/360_F_248556444_mfV4MbFD2UnfSofsOJeA8G7pIU8Yzfqc.jpg';
                    $imageUrl = isset($images[0]) ? asset('goods_img/' . $images[0]->img_url) : $defaultImageUrl;
                    $formattedPrice = 'Rp ' . number_format($mygood->g_price_prediction, 0, ',', '.');
                    @endphp

                    <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image"
                        data-product-image="{{ $imageUrl }}">
                    <div class="px-4 py-4">
                        <input type="hidden" id="goods_owner" value="{{ $product->us_ID }}" />
                        <div class="font-bold text-lg mb-2">{{ $mygood->g_name }}</div>
                        <hr class="my-2 border-b-2 border-gray-800"> <!-- Garis pembatas -->
                        <p class="hidden text-gray-700 text-base mb-2">{{ $mygood->g_desc }}</p>
                        <div class="grid grid-cols-1 gap-2 mt-3 bg-pink-100 border border-gray-300 rounded-lg p-4">
                            <div>
                                <p class="text-gray-700" style="font-size: 1em;"><span
                                        class="font-bold">Category:</span>
                                    {{ $mygood->g_category }}
                                </p>
                                <p class="text-gray-700"><span class="font-bold">Condition:</span>
                                    {{ $mygood->g_type }}
                                </p>
                                <p class="text-gray-700"><span class="font-bold">Age:</span>
                                    {{ $mygood->g_age }} <span>Years</span>
                                </p>
                                <p class="text-gray-700"><span class="font-bold">Price Prediction:</span>
                                    {{$formattedPrice }}
                                </p>
                                <span class="hidden product-price">{{ $mygood->g_price_prediction }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Keluar dari foreach setelah menemukan hasil cocok pertama --}}
                @break
                @endif
                @endforeach
                @endforeach
            </div>

            @else
            <div class="flex justify-center">
                <div class="text-xl text-[#F12E52] mt-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 00-1 1v8a1 1 0 002 0V4a1 1 0 00-1-1zm0 12a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>You haven't wishlisted this item from {{ $userDetails->us_name }}</span>
                </div>
            </div>
            @endif


            <hr class="my-4 border-b-1 border-gray-800"> <!-- Garis pembatas -->

            <!-- After displaying the current product's details, fetch and shuffle similar products -->
            @php
            // Get the predicted price of the current product
            $predictedPrice = $product->g_price_prediction;

            // Calculate price range for fetching similar products (e.g., +/- 20%)
            $minPrice = $predictedPrice * 0.8;
            $maxPrice = $predictedPrice * 1.2;

            // Fetch similar products within the price range
            $similarProducts = App\Models\Goods::whereBetween('g_price_prediction', [$minPrice, $maxPrice])
            ->where('g_ID', '!=', $product->g_ID)
            ->inRandomOrder()
            ->limit(5)
            ->get();
            @endphp

            <!-- Display shuffled similar products -->
            @if($similarProducts->count() > 0)
            <div class="text-2xl mt-8 mb-4 text-[#F12E52]"><b>Goods with</b><span
                    class="font-bold text-sm text-gray-600 mx-4">similar price</span></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($similarProducts as $similarProduct)

                <div class="max-w-md rounded overflow-hidden shadow-lg product-card">
                    @php
                    $images = $similarProduct->images;
                    $defaultImageUrl =
                    'https://t3.ftcdn.net/jpg/02/48/55/64/360_F_248556444_mfV4MbFD2UnfSofsOJeA8G7pIU8Yzfqc.jpg';
                    $imageUrl = isset($images[0]) ? asset('goods_img/' . $images[0]->img_url) : $defaultImageUrl;
                    $formattedPrice = 'Rp ' . number_format($similarProduct->g_price_prediction, 0, ',', '.');
                    @endphp

                    <img class="w-full h-64 object-cover object-center" src="{{ $similarProduct -> $imageUrl }}"
                        alt="Product Image" data-product-image="{{ $similarProduct -> $imageUrl }}">
                    <div class="px-4 py-4">
                        <input type="hidden" id="goods_owner" value="{{ $product->us_ID }}" />
                        <div class="font-bold text-lg mb-2">{{ $similarProduct->g_name }}</div>
                        <hr class="my-2 border-b-2 border-gray-800"> <!-- Garis pembatas -->
                        <p class="hidden text-gray-700 text-base mb-2">{{ $similarProduct->g_desc }}
                        </p>
                        <div class="grid grid-cols-1 gap-2 mt-3 bg-pink-100 border border-gray-300 rounded-lg p-4">
                            <div>
                                <p class="text-gray-700" style="font-size: 1em;"><span
                                        class="font-bold">Category:</span>
                                    {{ $similarProduct->g_category }}
                                </p>
                                <p class=" text-gray-700"><span class="font-bold">Condition:</span>
                                    {{ $similarProduct->g_type }}
                                </p>
                                <p class="text-gray-700"><span class="font-bold">Age:</span>
                                    {{ $similarProduct->g_age }} <span>Years</span>
                                </p>
                                <p class=" text-gray-700"><span class="font-bold">Price Prediction:</span>
                                    {{$formattedPrice }}
                                </p>
                                <span class="hidden product-price">{{ $similarProduct->g_price_prediction }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('goods_detail', ['hashed_id' => Hashids::encode($similarProduct->g_ID)]) }}"
                        id="btn_see_detail"
                        class="bg-purple-500 text-white px-4 py-3 rounded-lg hover:bg-gray-600 transition duration-300 flex items-center justify-center"
                        style="min-width: 200px;" data-product-image="{{ $imageUrl }}"
                        data-product-id="{{ $product->g_ID }}" data-product-name="{{ $similarProduct->g_name }}"
                        data-product-user-id="{{ $similarProduct->us_ID }}"
                        data-product-desc="{{ $similarProduct->g_desc }}"
                        data-product-category="{{ $similarProduct->g_category }}"
                        data-product-category="{{ $similarProduct->g_age }}"
                        data-product-type="{{ $similarProduct->g_type }}" data-product-price="{{ $formattedPrice }}">
                        View Details
                    </a>

                </div>
                @endforeach
            </div>
            @endif

        </section>

        @include('utils.layouts.footer.footer')
    </div>
</div>


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
    var currentImageIndex = 0;
    var images = document.querySelectorAll('.product-image');

    function showNextImage() {
        images[currentImageIndex].classList.add('hidden');
        currentImageIndex = (currentImageIndex + 1) % images.length;
        images[currentImageIndex].classList.remove('hidden');
    }

    // Change image every 3 seconds
    setInterval(showNextImage, 3000);

    function addToWishlist(productId, userId) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        var data = {
            g_ID: productId,
            us_ID: userId,
        };

        $.ajax({
            url: '../api/wishlist/store',
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

        // Setelah tombol diklik, ubah kelasnya untuk membuatnya tetap merah
        $(this).find('.love-icon').addClass('text-red-500');
        $(this).find('.love-icon').addClass('bg-red-50');
        $(this).find('.love-icon').addClass('border');
        $(this).find('.love-icon').addClass('border-red-500');
    });
</script>