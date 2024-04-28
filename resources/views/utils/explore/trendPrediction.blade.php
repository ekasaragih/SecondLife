<div class="my-10 relative">
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-red-500 mb-4">What's trend now? </h2>

        <div class="product-trend-slider-container overflow-hidden relative">
            <!-- Product Cards -->

            <div class="flex" id="product_data">
                @foreach($products as $product)
                <div class="product-trend-card flex-none w-1/4 border border-gray-300 location-name" id="product_detail"
                    data-location="">
                    @php
                    $images = $product->images;
                    $defaultImageUrl =
                    'https://cdn.eraspace.com/media/catalog/product/i/p/ipad_gen_10_10_9_inci_wi-fi_cellular_pink_1.jpg';
                    $imageUrl = isset($images[0]) ? $images[0]->img_url : $defaultImageUrl;
                    $formattedPrice = 'Rp ' . number_format($product->g_price_prediction, 0, ',', '.');
                    @endphp
                    <!-- Assuming no image here -->
                    <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image"
                        data-product-image="{{ $imageUrl }}">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2" id="goods_name">{{ $product->g_name }}</h3>
                        <p class="text-sm text-gray-600" id="goods_desc">{{ $product->g_desc }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600 text-xs" id="goods_ori_price">Price: Rp{{
                                number_format($product->g_original_price, 0, ',', '.')
                                }}</span>
                            @auth
                            <div class="flex justify-center items-center">
                                <a href="{{ route('goods_detail', ['id' => $product->g_ID]) }}"
                                    class="bg-red-400 text-white text-sm px-4 py-2 rounded hover:bg-red-600 transition duration-300 text-center">
                                    Detail
                                </a>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Tombol untuk menggeser ke kiri -->
        <button class="product-trend-slider-btn trend left-0" onclick="slideTrendLeft()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <!-- Tombol untuk menggeser ke kanan -->
        <button class="product-trend-slider-btn trend right-0" onclick="slideTrendRight()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>


<script>
    // Ambil elemen slide dan tombol
    const productTrendSlider = document.querySelector('.product-trend-slider-container');
    const slideLeftTrendBtn = document.querySelector('.product-trend-slider-btn.trend.left-0');
    const slideRightTrendBtn = document.querySelector('.product-trend-slider-btn.trend.right-0');
    const productTrendCards = document.querySelectorAll('.product-trend-card');
    const cardTrendWidth = productCards[0].offsetWidth + parseInt(getComputedStyle(productCards[0]).marginLeft) + parseInt(getComputedStyle(productCards[0]).marginRight);
    const visibleTrendCards = 4; 
    let startTrendIndex = 0;
    let endTrendIndex = visibleTrendCards - 1;
    let filteredTrendProducts = [];

    // Panggil fungsi resetIndexes saat struktur HTML lengkap dimuat
    window.addEventListener('load', resetTrendIndexes);
    
    // Fungsi untuk mengatur ulang indeks awal dan akhir setelah struktur HTML lengkap dimuat
    function resetTrendIndexes() {
        endTrendIndex = visibleTrendCards - 1;
        showHideCards(filteredTrendProducts);
    }

    // Fungsi untuk menampilkan atau menyembunyikan kartu produk berdasarkan indeks
    function showHideTrendCards(cards) {
        cards.forEach((card, index) => {
            if (index >= startTrendIndex && index <= endTrendIndex) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function slideTrendLeft() {
        if (startTrendIndex > 0) {
            startTrendIndex--;
            endTrendIndex--;
            productTrendSlider.scrollLeft -= cardTrendWidth;
            showHideTrendCards(productTrendCards);
        }
    }

    function slideTrendRight() {
        if (endTrendIndex < {{ count($products) }} - 1) {
            startTrendIndex++;
            endTrendIndex++;
            productTrendSlider.scrollLeft += cardTrendWidth;
            showHideTrendCards(productTrendCards);
        }
    }

    function filterTrendProducts(location) {
        productTrendCards.forEach(card => {
            if (location === 'All' || card.dataset.location.toLowerCase() === location.toLowerCase()) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
        resetTrendIndexes();
    }

</script>