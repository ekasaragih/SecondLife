@php
    $categories = \App\Models\Goods::distinct('g_category')->pluck('g_category');
@endphp

<div class="flex gap-2 px-2">
    <select class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" onchange="filterByCategory(this.value)">
        <option value="All">All</option>
        @foreach($categories as $category)
            <option value="{{ $category }}">{{ $category }}</option>
        @endforeach
    </select>
</div>

<br>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
    @php
        $products = \App\Models\Goods::getAllGoodsWithImages();
    @endphp
    @foreach($products as $product)
        <div class="max-w-md rounded overflow-hidden shadow-lg product-card" style="display: block;height: 500px;">
            @php
                // Ambil gambar pertama produk dari relasi
                $firstImage = $product->images->first();
                // URL gambar dari tabel goods_image
                $imageUrl = $firstImage ? $firstImage->img_url : 'https://cdn.eraspace.com/media/catalog/product/i/p/ipad_gen_10_10_9_inci_wi-fi_cellular_pink_1.jpg'; // Menggunakan URL gambar dari database
                // Ubah format harga
                $formattedPrice = 'Rp ' . number_format($product->g_original_price, 0, ',', '.');
            @endphp
            <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $product->g_name }}</div>
                <p class="text-gray-700 text-base mb-2">{{ $product->g_desc }}</p>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <p class="text-gray-700"><span class="font-bold">Category:</span> {{ $product->g_category }}</p>
                        <p class="text-gray-700"><span class="font-bold">Condition:</span> {{ $product->g_type }}</p>
                        <p class="text-gray-700"><span class="font-bold">Age:</span> {{ $product->g_age }}</p>
                        <p class="text-gray-700"><span class="font-bold">Price:</span> {{ $formattedPrice }}</p>
                    </div>
                    <div class="flex justify-end items-center">
                        <button class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300"
                                onclick="openProductModal('{{ $product->g_name }}', '{{ $product->g_desc }}', '{{ $product->g_category }}', '{{ $product->g_type }}', '{{ $formattedPrice }}')">
                            View Details
                        </button>
                        &nbsp;
                        <button class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300"
                                onclick="addToWishlist('{{ $product->id }}', '{{ $product->g_name }}', '{{ $formattedPrice }}', '{{ $imageUrl }}', '{{ $product->g_type }}')">
                            Add to Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div><br><br>

<!-- Product Modal -->
<div id="productModal" class="modal" style="background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; z-index: 1000; top: 0; left: 0; width: 100%; height: 100%; overflow: auto;">
    <div class="modal-content" style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 600px; position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <div class="flex justify-end p-4">
            <button class="text-gray-500 hover:text-gray-600 focus:outline-none" onclick="closeProductModal()">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-8" style="text-align: center;">
            <img id="modalImage" src="" alt="Product Image" style="max-width: 50%; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
            <h2 id="productName" class="text-2xl font-semibold mb-4"></h2>
            <p id="productDesc" class="text-lg text-gray-700 mb-4"></p>
            <p id="productCategory" class="text-lg text-gray-700 mb-2"></p>
            <p id="productType" class="text-lg text-gray-700 mb-2"></p>
            <p id="productPrice" class="text-lg text-gray-700 mb-2"></p>
            <div class="flex justify-center">
                <button class="bg-purple-500 text-white px-6 py-3 rounded hover:bg-gray-600 transition duration-300" onclick="startBarter()">Click to Barter</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Wishlist
    function addToWishlist(id, name, price, image, type) {
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        let product = { id, name, price, image, type };

        if (wishlist.some(item => item.id === id)) {
            Swal.fire("Product already exists in the wishlist!");
        } else {
            wishlist.push(product);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            Swal.fire("Product added to the Wishlist!");
        }
    }

    // Open Product Modal
    function openProductModal(name, desc, category, type, price) {
        document.getElementById('productName').textContent = name;
        document.getElementById('productDesc').textContent = desc;
        document.getElementById('productCategory').textContent = 'Category: ' + category;
        document.getElementById('productType').textContent = 'Type: ' + type;
        document.getElementById('productPrice').textContent = 'Price: ' + price;
        document.getElementById('productModal').style.display = 'block';
    }

    // Close Product Modal
    function closeProductModal() {
        document.getElementById('productModal').style.display = 'none';
    }

    // Filter by Category
    function filterByCategory(category) {
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            const productCategoryElement = card.querySelector('p:nth-child(1)');
            if (productCategoryElement) {
                const productCategoryText = productCategoryElement.textContent.trim();
                const categoryIndex = productCategoryText.indexOf('Category:');
                if (categoryIndex !== -1) {
                    const productCategory = productCategoryText.slice(categoryIndex + 'Category:'.length).trim();
                    if (category === 'All' || productCategory.toLowerCase() === category.toLowerCase()) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            }
        });
    }
</script>
