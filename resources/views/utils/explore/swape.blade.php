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
                @foreach($products as $index => $good)
                <div id="carousel-item-{{ $index }}" class="duration-700 ease-in-out transition-transform {{ $index === 0 ? '' : 'hidden' }}" data-product-id="{{ $good->id }}">
                    <img src="{{ $good->images->isEmpty() ? 'https://via.placeholder.com/400x300' : $good->images[0]->image_url }}" class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full" alt="{{ $good->g_name }}" />
                    <div class="carousel-item-caption bg-black bg-opacity-50 p-4 text-white rounded-md absolute top-0 left-0 right-0">
                        <p class="mb-0 text-lg font-bold">ID: {{ $good->g_ID }}</p>
                        <p class="mb-0 text-lg font-bold">Name: {{ $good->g_name }}</p>
                        <p class="mb-0">Description: {{ $good->g_desc }}</p>
                        <p>Price: Rp {{ number_format($good->g_original_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <button id="data-carousel-prev" type="button" class="group absolute left-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white">
                    <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="hidden">Previous</span>
                </span>
            </button>
            <button id="data-carousel-next" type="button" class="group absolute right-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white">
                    <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="hidden">Next</span>
                </span>
            </button>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const items = document.querySelectorAll('[id^="carousel-item-"]');
    const prevButton = document.getElementById("data-carousel-prev");
    const nextButton = document.getElementById("data-carousel-next");
    let currentIndex = 0;

    function showSlide(index) {
        items.forEach(item => item.classList.add("hidden"));
        items[index].classList.remove("hidden");
    }

    function showNextSlide() {
        currentIndex = (currentIndex + 1) % items.length;
        const currentProduct = items[currentIndex].dataset.productId;

        addToWishlist(currentProduct);
        showSlide(currentIndex);
    }

    function showPrevSlide() {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        showSlide(currentIndex);
    }

    function addToWishlist(productId) {
        fetch('{{ route('wishlist.add') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                g_ID: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    nextButton.addEventListener("click", showNextSlide);
    prevButton.addEventListener("click", showPrevSlide);

    var swipeContainer = document.getElementById('carousel-example');
    var swipe = new Hammer(swipeContainer);

    swipe.on('swiperight', function() {
        var productId = swipeContainer.querySelector('.carousel-item:not(.hidden)').dataset.productId;
        addToWishlist(productId);
    });

    swipe.on('swipeleft', function() {
        var productId = swipeContainer.querySelector('.carousel-item:not(.hidden)').dataset.productId;
        // Di sini Anda dapat menambahkan logika apa pun untuk menangani swipe ke kiri
        // Misalnya, mengganti ke produk berikutnya tanpa menambahkannya ke wishlist
        showNextSlide();
    });
});
</script>