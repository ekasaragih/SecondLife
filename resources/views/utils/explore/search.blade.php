<div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-4">Search Results</h1>
        <div class="grid grid-cols-3 gap-4">
            @foreach($products as $product)
                <div class="p-4 border rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold">{{ $product->g_name }}</h2>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <p class="mt-2 text-gray-700">Price: ${{ $product->price }}</p>
                </div>
            @endforeach
        </div>
    </div>