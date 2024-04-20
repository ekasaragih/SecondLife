<div class="my-10 relative">
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-red-500 mb-4">What's trend now? </h2>

        <div class="product-trend-slider-container overflow-hidden relative">
            <!-- Product Cards -->

            <div class="flex" id="product_data">
                @foreach($products as $product)
                <div class="product-card flex-none w-1/4 border border-gray-300 location-name" id="product_detail"
                    data-location="">
                    <!-- Assuming no image here -->
                    <img src="https://via.placeholder.com/400" alt="Product Image">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2" id="goods_name">{{ $product->g_name }}</h3>
                        <p class="text-sm text-gray-600" id="goods_desc">{{ $product->g_desc }}</p>
                        <p class="text-sm text-gray-600" id="goods_location">Location: user location</p>
                        <div class="mt-4 flex justify-between items-center">
                            {{-- Ini nanti diganti jadi harga yang setelah dikalkulasiin --}}
                            <span class="text-gray-600" id="goods_ori_price">Price: Rp{{
                                number_format($product->g_original_price, 0, ',', '.')
                                }}</span>
                            <button
                                class="bg-purple-500 text-white px-4 py-2 ml-2 rounded hover:bg-gray-600 transition duration-300"
                                style="font-size: 14px;"
                                onclick="openTrendModal('{{ $product->g_name }}', '{{ $product->g_desc }}', 'UserLocation', '{{ $product->g_original_price }}')">Detail</button>
                            <button
                                class=" bg-purple-500 text-white px-4 py-2 ml-1 rounded hover:bg-gray-600 transition duration-300"
                                style="font-size: 14px;">Add</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Tombol untuk menggeser ke kiri -->
        <button class="product-trend-slider-btn left-0" onclick="slideTrendLeft()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <!-- Tombol untuk menggeser ke kanan -->
        <button class="product-trend-slider-btn right-0" onclick="slideTrendRight()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>

<div id="productTrendModal"
    class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 items-center justify-center hidden z-50">
    <div class="modal-content"
        style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 600px; position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <span class="close" onclick="closeTrendModal()"
            style="position: absolute; top: 10px; right: 10px; font-size: 24px; cursor: pointer; color: #888; z-index: 1;">&times;</span>
        <h2 id="modalTrendTitle"
            style="color: #333; text-align: center; font-size: 28px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            Product Details</h2>
        <div class="text-center">
            <img id="modalTrendImage" src="" alt="Product Image"
                style="max-width: 50%; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
            <p id="modalTrendLocation" style="color: #666; margin-bottom: 10px;"></p>
            <p id="modalTrendPrice" style="color: #666; margin-bottom: 20px;"></p>
        </div>
        <p id="modalTrendDescription" style="color: #666; text-align: justify;"></p>
        <div class="text-center">
            <button
                class="bg-purple-500 text-white px-4 py-2 ml-2 rounded hover:bg-gray-600 transition duration-300 mt-2"
                onclick="barterNow()">Click to Barter</button>
        </div>
    </div>
</div>



<script>
    // Function to open modal with product details
    function openTrendModal(name, description, location, price) {
        const modalTrend = document.getElementById('productTrendModal');
        const modalTrendTitle = document.getElementById('modalTrendTitle');
        const modalTrendDescription = document.getElementById('modalTrendDescription');
        const modalTrendImage = document.getElementById('modalTrendImage');
        const modalTrendLocation = document.getElementById('modalTrendLocation');
        const modalTrendPrice = document.getElementById('modalTrendPrice');

        modalTrend.style.display = 'block';
        modalTrendTitle.textContent = name;
        modalTrendDescription.textContent = description;
        modalTrendImage.src = "https://via.placeholder.com/400";
        modalTrendLocation.textContent = "Location: " + location;
        const formattedPrice = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(price);

        modalTrendPrice.textContent = "Price: " + formattedPrice;
    }


    // Function to close modal
    function closeTrendModal() {
        var modal = document.getElementById('productTrendModal');
        modal.style.display = "none";
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('productTrendModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Ambil elemen slide dan tombol
    const productTrendSlider = document.querySelector('.product-trend-slider-container');
    const slideLeftTrendBtn = document.querySelector('.product-trend-slider-btn.left-0');
    const slideRightTrendBtn = document.querySelector('.product-trend-slider-btn.right-0');
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
            showHideCards();
        }
    }

    // Fungsi untuk menggeser slide ke kanan
    function slideTrendRight() {
        if (startTrendIndex > 0) {
            startTrendIndex--;
            endTrendIndex--;
            productTrendSlider.scrollLeft += cardTrendWidth;
            showHideTrendCards();
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