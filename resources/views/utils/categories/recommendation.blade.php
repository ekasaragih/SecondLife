{{-- Recommendation based on Categories --}}
<div class="space-y-2 space-x-2">
    <div class="text-3xl text-[#F12E52]"><b>Recommendation</b><span class="font-bold text-sm text-gray-600 mx-4">based
            on your preferences</span></div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-4">

        @foreach ($nonWishlistProducts as $product)
        <div class="recommendation-card bg-gray-100 rounded-lg p-4 flex flex-col justify-between">
            <img src="{{ $product->images->first()->img_url ?? 'https://via.placeholder.com/150' }}"
                alt="{{ $product->g_name }}" class="w-full mb-2">
            <h3 class="mb-1 text-xl font-semibold">{{ $product->g_name }}</h3>
            <p class="mb-1 text-lg">Price: Rp {{ number_format($product->g_original_price, 0, ',', '.') }}</p>
            <p class="mb-4 text-lg">Category: {{ $product->g_category }}</p>
            <button
                class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300 add-to-wishlist"
                id="btn_add_wishlist" data-product-id="{{ $product->g_ID }}" data-user-id="{{ $user->us_ID }}">
                Add to Wishlist
            </button>
        </div>
        @endforeach
    </div>
</div>