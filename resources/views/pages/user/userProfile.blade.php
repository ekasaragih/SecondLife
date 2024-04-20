<!-- userProfile.blade.php -->

@include('utils.layouts.navbar.topnav')

<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">User Profile</h1>

    <!-- Tampilkan us_id -->
    <p>Us ID: {{ $us_id }}</p>

    <!-- Tampilkan produk yang sesuai dengan us_id -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($products as $product)
        <div class="bg-white p-4 rounded-lg shadow-md">
            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-40 object-cover mb-4 rounded-md">
            <h2 class="text-lg font-semibold mb-2">{{ $product['name'] }}</h2>
            <p class="text-sm text-gray-600 mb-2">{{ $product['description'] }}</p>
            <p class="text-sm text-gray-600 mb-2">Location: {{ $product['location'] }}</p>
            <p class="text-sm text-gray-600 mb-2">Price: {{ $product['price'] }}</p>
        </div>
        @endforeach
    </div>
</div>

@include('utils.layouts.footer.footer')
