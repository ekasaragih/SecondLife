<div class="grid grid-cols-4 gap-4">
    <div class="col-span-1">
        <div class="text-3xl text-[#F12E52]"><b>Swape</b></div>
        <div class="text-xl mt-4 italic">
            Swap your goods by swiping! Swipe to the right for match and left to unmatch!
        </div>
        <div class="mt-6 text-gray-600">Find your perfect match now!</div>
        <div class="mt-4">
            <img src="https://png.pngtree.com/png-clipart/20200707/ourlarge/pngtree-mobile-phone-like-3d-element-png-image_2285401.jpg" class="w-40 h-40 rounded-full border-2 border-white" alt="Your Image">
        </div>
    </div>

    <div class="col-span-3 place-items-center p-6 bg-white border border-black rounded-lg shadow-lg relative">
        <div id="carousel-example" class="relative w-full">
            <div class="relative h-64 overflow-hidden rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                @foreach($products as $index => $product)
                <div id="carousel-item-{{ $index }}" class="duration-700 ease-in-out transition-transform {{ $index === 0 ? '' : 'hidden' }}" data-product-id="{{ $product->id }}">
                    <img src="{{ $product->images->isEmpty() ? 'https://via.placeholder.com/400x300' : $product->images[0]->image_url }}" class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full" alt="{{ $product->g_name }}" />
                    <div class="carousel-item-caption bg-black bg-opacity-50 p-4 text-white rounded-md absolute top-0 left-0 right-0">
                        <p class="mb-0 text-lg font-bold">ID: {{ $product->g_ID }}</p>
                        <p class="mb-0 text-lg font-bold">Name: {{ $product->g_name }}</p>
                        <p class="mb-0">Description: {{ $product->g_desc }}</p>
                        <p>Price: Rp {{ number_format($product->g_original_price, 0, ',', '.') }}</p>
                    </div>
                    <button id="data-carousel-prev" type="button" class="group absolute left-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white">
                    <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="hidden">Previous</span>
                </span>
            </button>
            <button id="data-carousel-next" type="button" class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300 btn-add-to-wishlist group absolute right-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none" data-product-id="{{ $product->g_ID }}" data-user-id="{{ $user->us_ID }}">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white">
                    <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="hidden">Next</span>
                </span>
            </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll('[id^="carousel-item-"]');
    const prevButton = document.getElementById("data-carousel-prev");
    const nextButton = document.getElementById("data-carousel-next");
    const swipeContainer = document.getElementById('carousel-example');
    let currentIndex = 0;
    let swipeEnabled = true;
    const mc = new Hammer(swipeContainer);

    function showSlide(index) {
        items.forEach(item => item.classList.add("hidden"));
        items[index].classList.remove("hidden");
    }

    function showNextSlide() {
        currentIndex = (currentIndex + 1) % items.length;
        showSlide(currentIndex);
    }

    function showPrevSlide() {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        showSlide(currentIndex);
    }

    function addToWishlistAndShowNextSlide(productId, userId) {
    addToWishlist(productId, userId, function() {
        var currentProductId = nextButton.dataset.productId;
        var currentProductIndex = Array.from(items).findIndex(item => item.dataset.productId === currentProductId);
        if (currentProductIndex !== -1) {
            items[currentProductIndex].classList.add("hidden");
            if (currentProductIndex === currentIndex) {
                currentIndex = (currentIndex + 1) % items.length;
            }
        }
        showNextSlide();
        nextButton.dataset.productId = items[currentIndex].dataset.productId;
        // Pilih produk berikutnya setelah menambahkannya ke wishlist
        var nextProductIndex = (currentIndex + 1) % items.length;
        var nextProductId = items[nextProductIndex].dataset.productId;
        nextButton.dataset.productId = nextProductId;
    });
}


    function addToWishlist(productId, userId, callback) {
        var data = {
            g_ID: productId,
            us_ID: userId,
        };

        // Perbarui URL endpoint AJAX sesuai dengan rute yang telah ditambahkan
        $.ajax({
            url: 'api/wishlist/store',
            method: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        callback();
                    });
                } else {
                    if (response.message.includes('already added')) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops...',
                            text: response.message,
                        }).then(function() {
                            location.reload();
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

    mc.get('swipe').set({ direction: Hammer.DIRECTION_HORIZONTAL });

// Menambahkan event listener untuk swipe ke kanan
mc.on('swiperight', handleSwipeRight);

// Menambahkan event listener untuk swipe ke kiri
mc.on('swipeleft', handleSwipeLeft);

// Function to handle swipe to the right
function handleSwipeRight() {
    if (swipeEnabled) {
        swipeEnabled = false;
        var productId = swipeContainer.querySelector('.carousel-item:not(.hidden)').dataset.productId;
        var userId = '{{ $user->us_ID }}';
        var alreadyInWishlist = checkIfInWishlist(productId, userId);
        if (!alreadyInWishlist) {
            addToWishlistAndShowNextSlide(productId, userId);
        } else {
            showNextSlide();
        }
        currentIndex = (currentIndex + 1) % items.length; // Update currentIndex
        setTimeout(function() {
            swipeEnabled = true;
        }, 1000);
    }
}

// Function to handle swipe to the left
function handleSwipeLeft() {
    if (swipeEnabled) {
        swipeEnabled = false;
        showPrevSlide();
        currentIndex = (currentIndex - 1 + items.length) % items.length; // Update currentIndex
        setTimeout(function() {
            swipeEnabled = true;
        }, 1000);
    }
}


    nextButton.addEventListener("click", function() {
        var productId = nextButton.dataset.productId;
        var userId = nextButton.dataset.userId;
        addToWishlistAndShowNextSlide(productId, userId);
    });

    prevButton.addEventListener("click", showPrevSlide);

    // Fungsi untuk memeriksa apakah produk sudah ada dalam wishlist

});


</script>
