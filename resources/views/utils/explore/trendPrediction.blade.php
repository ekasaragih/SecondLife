<div class="my-10 relative">
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-red-500 mb-4">What's trend now? </h2>

        <div class="product-slider-container overflow-hidden relative">
            <!-- Product Cards -->

            <div class="flex" id="productCards">
                @foreach($products as $product)
                <div class="product-card flex-none w-1/4 border border-gray-300 location-name" data-location="">
                    <!-- Assuming no image here -->
                    <img src="https://via.placeholder.com/400" alt="Product Image">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->g_name }}</h3>
                        <p class="text-sm text-gray-600">{{ $product->g_desc }}</p>
                        <p class="text-sm text-gray-600">Location: user location</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600">Price: {{ $product->g_original_price }}</span>
                            <button
                                class="bg-purple-500 text-white px-4 py-2 ml-2 rounded hover:bg-gray-600 transition duration-300"
                                style="font-size: 14px;"
                                onclick="openModal('{{ $product->g_name }}, {{ $product->g_desc }}, {{ $product->images->first()->image_url }}, user location, {{ $product->g_original_price }}')">Detail</button>
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
        <button class="product-slider-btn left-0" onclick="slideLeft()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <!-- Tombol untuk menggeser ke kanan -->
        <button class="product-slider-btn right-0" onclick="slideRight()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>

<div id="productModal" class="modal"
    style="background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; z-index: 1000; top: 0; left: 0; width: 100%; height: 100%; overflow: auto;">
    <div class="modal-content"
        style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 600px; position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <span class="close" onclick="closeModal()"
            style="position: absolute; top: 10px; right: 10px; font-size: 24px; cursor: pointer; color: #888; z-index: 1;">&times;</span>
        <h2 id="modalTitle"
            style="color: #333; text-align: center; font-size: 28px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            Product Details</h2>
        <div style="text-align: center;">
            <img id="modalImage" src="" alt="Product Image"
                style="max-width: 50%; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
            <p id="modalLocation" style="color: #666; margin-bottom: 10px;"></p>
            <p id="modalPrice" style="color: #666; margin-bottom: 20px;"></p>
        </div>
        <p id="modalDescription" style="color: #666; text-align: justify;"></p>
        <div style="text-align: center;">
            <button
                class="bg-purple-500 text-white px-4 py-2 ml-2 rounded hover:bg-gray-600 transition duration-300 mt-2"
                onclick="addToCart()">Add to Cart</button>
        </div>
    </div>
</div>