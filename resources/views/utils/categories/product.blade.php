<div class="flex gap-2 px-2">
    <button class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" onclick="filterProducts('All')">All</button>
    <button class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" onclick="filterProducts('Fashion')">Fashion</button>
    <button class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" onclick="filterProducts('Skincare')">Skincare</button>
    <button class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" onclick="filterProducts('Electronic')">Electronic</button>
</div><br>
        <div class="product-slider-container overflow-hidden relative">
            <!-- Product Cards -->
            @php
            $products = [
                [
                    'name' => 'Iphone 15',
                    'price' => '$19.99',
                    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-Klj9zb0sXy-rG1aiNMuw1-dChFq9Bm1bnaDukC5REg&s',
                    'type' => 'Electronic',
                ],
                [
                    'name' => 'Samsung J2',
                    'price' => '$29.99',
                    'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjhJ76DpyyhN1B9uG4LKOVCdblP5pE1zZynW0FW_2GIQ&s',
                    'type' => 'Electronic',
                ],
                [
                    'name' => 'Zlota 3in1',
                    'price' => '$39.99',
                    'image' => 'https://beautify.id/image/cache/catalog/products/ZLO002-8-1200x1200.jpg',
                    'type' => 'Skincare',
                ],
                [
                    'name' => 'Highwaist Jeans',
                    'price' => '$49.99',
                    'image' => 'https://img.lazcdn.com/g/p/a57714bcbff89c8a3db5a69777436236.jpg_720x720q80.jpg',
                    'type' => 'Fashion',
                ],
                [
                    'name' => 'Originote Sunscreen',
                    'price' => '$59.99',
                    'image' => 'https://images.soco.id/2dfd6f46-ef81-459b-9da7-b8732b1dfd5d-.jpg',
                    'type' => 'Skincare',
                ],
                [
                    'name' => 'Oversize Tee',
                    'price' => '$69.99',
                    'image' => 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2023/1/5/efc92d38-118a-48a1-b6dd-39b0a63add4e.jpg',
                    'type' => 'Fashion',
                ],
                [
                    'name' => 'Ipad Gen 10',
                    'price' => '$79.99',
                    'image' => 'https://cdn.eraspace.com/media/catalog/product/i/p/ipad_gen_10_10_9_inci_wi-fi_cellular_pink_1.jpg',
                    'type' => 'Electronic',
                ],
                [
                    'name' => 'Originote Retinol',
                    'price' => '$89.99',
                    'image' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/104/MTA-140397259/brd-94854_the-originote-moisturizer-hyalucera-moisturizer-gel-cica-b5-soothing-moisturizer-brightening-moisturizer_full01-87e7b918.jpg',
                    'type' => 'Skincare',
                ],
                [
                    'name' => 'Vaseline Jelly',
                    'price' => '$89.99',
                    'image' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//97/MTA-85941142/vaseline_vaseline-petroleum-jelly-100ml-original_full01.jpg',
                    'type' => 'Skincare',
                ],
            ];
            @endphp
            <div class="flex" id="productCards">
                @foreach($products as $index => $product)
                <div class="h-11 product-card flex-none w-1/4 border border-gray-300 {{ strtolower($product['type']) }}" data-type="{{ strtolower($product['type']) }}">
                    <img class="max-w-full h-auto" src="{{ $product['image'] }}" alt="Product Image">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product['name'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $product['type'] }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600">Price: {{ $product['price'] }}</span>
                            <button class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">Add to Wishlist</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Tombol untuk menggeser ke kiri -->
        <button class="product-slider-btn left-0" onclick="slideLeft()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <!-- Tombol untuk menggeser ke kanan -->
        <button class="product-slider-btn right-0" onclick="slideRight()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>
</div>

<script>
    // Ambil elemen slide dan tombol
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

    function slideRight() {
        if (endIndex < filteredProducts.length - 1) {
            startIndex++;
            endIndex++;
            productSlider.scrollLeft += cardWidth;
            showHideCards(filteredProducts);
        }
    }

    function filterProducts(type) {
    productCards.forEach(card => {
        if (type === 'All' || card.dataset.type.toLowerCase() === type.toLowerCase()) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
    resetIndexes();
}


</script>


