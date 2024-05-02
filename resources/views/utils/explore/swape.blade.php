<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="/asset/css/imgContainer.css">
    <style>
        /* Add this style to fit the images within the carousel */
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<div class="grid grid-cols-4 gap-4">
    <div class="col-span-1">
        <div class="text-3xl text-[#F12E52]"><b>Swape</b></div>
        <div class="text-xl mt-4 italic">
            Swap your goods here! Press the checklist to match and 'X' to unmatch!
        </div>
        <div class="mt-6 text-gray-600">Find your perfect match now!</div>
        <div class="mt-4">
            <img src="https://png.pngtree.com/png-clipart/20200707/ourlarge/pngtree-mobile-phone-like-3d-element-png-image_2285401.jpg"
                class="w-40 h-40 rounded-full border-2 border-white" alt="Product Image">
        </div>
    </div>

    <div class="col-span-3 place-items-center p-6 bg-white border border-black rounded-lg shadow-lg relative">
        <div id="carousel-example" class="relative w-full">
            <div class="relative h-64 overflow-hidden rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                @foreach ($products as $index => $product)
                <div id="carousel-item-{{ $index }}"
                    class="carousel-item duration-700 ease-in-out transition-transform {{ $index === 0 ? 'opacity-100' : 'opacity-0 hidden' }}">
                    @php
                    $images = $product->goodsImages;
                    $defaultImageUrl =
                    'https://t3.ftcdn.net/jpg/02/48/55/64/360_F_248556444_mfV4MbFD2UnfSofsOJeA8G7pIU8Yzfqc.jpg';
                    $imageUrl = isset($images[0]) ? asset('goods_img/' . $images[0]->img_url) : $defaultImageUrl;
                    $formattedPrice = 'Rp ' . number_format($product->g_price_prediction, 0, ',', '.');
                    @endphp

                    <img src="{{ $imageUrl }}"
                        class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full"
                        alt="{{ $product->g_name }}" data-product-image="{{ $imageUrl }}" />
                    <div
                        class="carousel-item-caption bg-black bg-opacity-50 p-4 text-white rounded-md absolute top-0 left-0 right-0">
                        <p class="mb-0 text-lg font-bold hidden" id="product_ID">ID: {{ $product->g_ID }}</p>
                        <p class="mb-0 text-lg font-bold">Name: {{ $product->g_name }}</p>
                        <p class="mb-2">Description: {{ $product->g_desc }}</p>
                        <p>Prediction Price: Rp {{ number_format($product->g_original_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
                <button id="data-carousel" type="button"
                    class="group absolute left-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                    <i class="fa fa-times inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white"
                        aria-hidden="true"></i>
                </button>
                </button>
                <button id="saveToWishlist" type="button"
                    class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300 btn-add-to-wishlist group absolute right-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                    <i class="fa fa-check inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white"
                        aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Select both buttons
    const carouselButton = document.getElementById('data-carousel');
    const wishlistButton = document.getElementById('saveToWishlist');
    const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');
    
    // Initialize currentIndex to keep track of the current carousel item
    let currentIndex = 0;

    // Add event listener for carousel button
    carouselButton.addEventListener('click', function() {
        const carouselItems = document.querySelectorAll('.carousel-item');
        
        // Increment the currentIndex for the next item
        currentIndex = (currentIndex + 1) % carouselItems.length;

        carouselItems.forEach((item, index) => {
            if (index === currentIndex) {
                item.classList.remove('opacity-0', 'hidden');
                item.classList.add('opacity-100');
            } else {
                item.classList.remove('opacity-100');
                item.classList.add('opacity-0', 'hidden');
            }
        });

        // Update goods_ID based on the currentIndex
        var goods_ID = document.getElementById(`carousel-item-${currentIndex}`).querySelector('#product_ID').textContent.trim().replace('ID:', '');
        console.log(goods_ID);
    });

    // Add event listener for wishlist button
    wishlistButton.addEventListener('click', function() {
        // Assuming the input with name "product_ID" is outside the button element
        var goods_ID = document.getElementById(`carousel-item-${currentIndex}`).querySelector('#product_ID').textContent.trim().replace('ID:', '');
        console.log(goods_ID);

        // Your AJAX code
        $.ajax({
            url: '{{ route('swipe') }}',
            type: 'POST',
            data: {
                goods_ID: goods_ID
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + apiToken
            },
            success: function(response) {
                console.log('response: ', response);
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        carouselButton.click();
                    }
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            }
        });
    });
});

</script>