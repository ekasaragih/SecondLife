<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Slider</title>
    <style>
        /* Styling untuk tombol geser */
        .product-slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product-slider-btn:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Styling untuk container produk */
        .product-slider-container {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none; /* Hide scrollbar for IE and Edge */
        }

        .product-card {
            flex: 0 0 calc(25% - 20px);
            margin: 10px;
            scroll-snap-align: start;
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="my-10 relative">
        <div class="mt-8">
            <h2 class="text-2xl font-bold text-red-500 mb-4">Recommended Products <span class="text-sm text-gray-600">based on location</span></h2>
            <div id="productSlider" class="product-slider-container">
                <!-- Product Cards -->
                @php
                $products = [
                    [
                        'name' => 'Product 1',
                        'description' => 'Description for Product 1',
                        'price' => '$19.99',
                        'image' => 'https://via.placeholder.com/400',
                    ],
                    [
                        'name' => 'Product 2',
                        'description' => 'Description for Product 2',
                        'price' => '$29.99',
                        'image' => 'https://via.placeholder.com/400',
                    ],
                    [
                        'name' => 'Product 3',
                        'description' => 'Description for Product 3',
                        'price' => '$39.99',
                        'image' => 'https://via.placeholder.com/400',
                    ],
                    [
                        'name' => 'Product 4',
                        'description' => 'Description for Product 4',
                        'price' => '$49.99',
                        'image' => 'https://via.placeholder.com/400',
                    ],
                    [
                        'name' => 'Product 5',
                        'description' => 'Description for Product 5',
                        'price' => '$59.99',
                        'image' => 'https://via.placeholder.com/400',
                    ],
                    [
                        'name' => 'Product 6',
                        'description' => 'Description for Product 6',
                        'price' => '$69.99',
                        'image' => 'https://via.placeholder.com/400',
                    ],
                    [
                        'name' => 'Product 7',
                        'description' => 'Description for Product 7',
                        'price' => '$79.99',
                        'image' => 'https://via.placeholder.com/400',
                    ],
                    [
                        'name' => 'Product 8',
                        'description' => 'Description for Product 8',
                        'price' => '$89.99',
                        'image' => 'https://via.placeholder.com/400',
                    ],
                ];
                @endphp
                @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ $product['image'] }}" alt="Product Image">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product['name'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $product['description'] }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600">Price: {{ $product['price'] }}</span>
                            <button class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">Add to Cart</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Tombol untuk menggeser ke kiri -->
            <button id="slideLeftBtn" class="product-slider-btn left-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <!-- Tombol untuk menggeser ke kanan -->
            <button id="slideRightBtn" class="product-slider-btn right-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>

    <script>
        // Ambil elemen slide dan tombol
        const productSlider = document.getElementById('productSlider');
        const slideLeftBtn = document.getElementById('slideLeftBtn');
        const slideRightBtn = document.getElementById('slideRightBtn');
        let cardWidth;
        const visibleCards = 4; // Jumlah kartu produk yang terlihat
        let startIndex = 0;
        let endIndex = visibleCards - 1;

        // Fungsi untuk mengatur ulang indeks awal dan akhir setelah struktur HTML lengkap dimuat
        function resetIndexes() {
            const firstCard = document.querySelector('.product-card');
            if (firstCard) {
                const cardStyle = window.getComputedStyle(firstCard);
                cardWidth = parseFloat(cardStyle.width) + parseFloat(cardStyle.marginLeft) + parseFloat(cardStyle.marginRight);
                endIndex = visibleCards - 1;
            }
        }

        // Panggil fungsi resetIndexes saat struktur HTML lengkap dimuat
        window.addEventListener('load', resetIndexes);

        // Fungsi untuk menggeser slide ke kiri
        function slideLeft() {
            if (startIndex > 0) {
                startIndex--;
                endIndex--;
                productSlider.scrollLeft -= cardWidth;
            }
        }

        // Fungsi untuk menggeser slide ke kanan
        function slideRight() {
            if (endIndex < products.length - 1) {
                startIndex++;
                endIndex++;
                productSlider.scrollLeft += cardWidth;
            }
        }

        // Tambahkan event listener pada tombol untuk memanggil fungsi saat diklik
        slideLeftBtn.addEventListener('click', slideLeft);
        slideRightBtn.addEventListener('click', slideRight);
    </script>
</body>
</html>
