<div class="my-10 relative">
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-red-500 mb-4">Recommended Products <span class="text-sm text-gray-600">based on location</span></h2>
        <div>
            <button class="bg-purple-500 text-white px-4 py-2 mb-5 rounded hover:bg-gray-600 transition duration-300" onclick="filterProducts('Jakarta')">Jakarta</button>
            <button class="bg-purple-500 text-white px-4 py-2 mb-5 rounded hover:bg-gray-600 transition duration-300" onclick="filterProducts('Bekasi')">Bekasi</button>
            <button class="bg-purple-500 text-white px-4 py-2 mb-5 rounded hover:bg-gray-600 transition duration-300" onclick="filterProducts('All')">All</button>
        </div>
        <div class="product-slider-container overflow-hidden relative">
            <!-- Product Cards -->
            @php
            $products = [
                [
                    'name' => 'Product 1',
                    'description' => 'Description for Product 1',
                    'price' => '$19.99',
                    'image' => 'https://via.placeholder.com/400',
                    'location' => 'Jakarta',
                ],
                [
                    'name' => 'Product 2',
                    'description' => 'Description for Product 2',
                    'price' => '$29.99',
                    'image' => 'https://via.placeholder.com/400',
                    'location' => 'Bekasi',
                ],
                [
                    'name' => 'Product 3',
                    'description' => 'Description for Product 3',
                    'price' => '$39.99',
                    'image' => 'https://via.placeholder.com/400',
                    'location' => 'Jakarta',
                ],
                [
                    'name' => 'Product 4',
                    'description' => 'Description for Product 4',
                    'price' => '$49.99',
                    'image' => 'https://via.placeholder.com/400',
                    'location' => 'Jakarta',
                ],
                [
                    'name' => 'Product 5',
                    'description' => 'Description for Product 5',
                    'price' => '$59.99',
                    'image' => 'https://via.placeholder.com/400',
                    'location' => 'Jakarta',
                ],
                [
                    'name' => 'Product 6',
                    'description' => 'Description for Product 6',
                    'price' => '$69.99',
                    'image' => 'https://via.placeholder.com/400',
                    'location' => 'Jakarta',
                ],
                [
                    'name' => 'Product 7',
                    'description' => 'Description for Product 7',
                    'price' => '$79.99',
                    'image' => 'https://via.placeholder.com/400',
                    'location' => 'Bekasi',
                ],
                [
                    'name' => 'Product 8',
                    'description' => 'Description for Product 8',
                    'price' => '$89.99',
                    'image' => 'https://via.placeholder.com/400',
                    'location' => 'Bekasi',
                ],
            ];
            @endphp
            <div class="flex" id="productCards">
                @foreach($products as $index => $product)
                <div class="product-card flex-none w-1/4 border border-gray-300 {{ strtolower($product['location']) }}" data-location="{{ strtolower($product['location']) }}">
                    <img src="{{ $product['image'] }}" alt="Product Image">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product['name'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $product['description'] }}</p>
                        <p class="text-sm text-gray-600">Location: {{ $product['location'] }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600">Price: {{ $product['price'] }}</span>
                            <button class="bg-purple-500 text-white px-4 py-2 ml-2 rounded hover:bg-gray-600 transition duration-300" style="font-size: 14px;" onclick="openModal('{{ $product['name'] }}', '{{ $product['description'] }}', '{{ $product['image'] }}', '{{ $product['location'] }}', '{{ $product['price'] }}')">Detail</button>
                            <button class="bg-purple-500 text-white px-4 py-2 ml-1 rounded hover:bg-gray-600 transition duration-300" style="font-size: 14px;">Add</button>
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

<div id="productModal" class="modal" style="background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; z-index: 1000; top: 0; left: 0; width: 100%; height: 100%; overflow: auto;">
    <div class="modal-content" style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 600px; position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <span class="close" onclick="closeModal()" style="position: absolute; top: 10px; right: 10px; font-size: 24px; cursor: pointer; color: #888; z-index: 1;">&times;</span>
        <h2 id="modalTitle" style="color: #333; text-align: center; font-size: 28px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px;">Product Details</h2>
        <div style="text-align: center;">
            <img id="modalImage" src="" alt="Product Image" style="max-width: 50%; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
            <p id="modalLocation" style="color: #666; margin-bottom: 10px;"></p>
            <p id="modalPrice" style="color: #666; margin-bottom: 20px;"></p>
        </div>
        <p id="modalDescription" style="color: #666; text-align: justify;"></p>
        <div style="text-align: center;">
            <button class="bg-purple-500 text-white px-4 py-2 ml-2 rounded hover:bg-gray-600 transition duration-300 mt-2" onclick="addToCart()">Add to Cart</button>
        </div>
    </div>
</div>



<script>
    // Function to open modal with product details
function openModal(name, description, image, location, price) {
    const modal = document.getElementById('productModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalImage = document.getElementById('modalImage');
    const modalLocation = document.getElementById('modalLocation');
    const modalPrice = document.getElementById('modalPrice');

    modal.style.display = 'block';
    modalTitle.textContent = name;
    modalDescription.textContent = description;
    modalImage.src = image;
    modalLocation.textContent = "Location: " + location;
    modalPrice.textContent = "Price: " + price;
}


    // Function to close modal
    function closeModal() {
        var modal = document.getElementById('productModal');
        modal.style.display = "none";
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('productModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

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
            showHideCards();
        }
    }

    // Fungsi untuk menggeser slide ke kanan
    function slideRight() {
        if (endIndex < {{ count($products) }} - 1) {
            startIndex++;
            endIndex++;
            productSlider.scrollLeft += cardWidth;
            showHideCards();
        }
    }

    function filterProducts(location) {
    productCards.forEach(card => {
        if (location === 'All' || card.dataset.location.toLowerCase() === location.toLowerCase()) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
    resetIndexes();
}

</script>
