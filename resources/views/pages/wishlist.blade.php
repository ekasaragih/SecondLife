<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

@include('utils.layouts.navbar.topnav')

    <div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52]"><b>Wishlist</b></div><br>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-4">
                <!-- Products will be added here -->
            </div>
        </div><br>

        <div class="text-3xl text-[#F12E52]"><b>Recommendation</b><span class="font-bold text-sm text-gray-600">based on your preferences</span></div><br>  
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-4">
        @php
        // Ambil daftar produk yang tidak termasuk dalam wishlist
        $nonWishlistProducts = \App\Models\Goods::all()->filter(function ($product) {
            return !in_array($product->id, collect(json_decode(request()->cookie('wishlist') ?? '[]'))->pluck('id')->toArray());
        })->shuffle()->take(8);
    @endphp

    @foreach($nonWishlistProducts as $product)
        @php
            // Ambil semua gambar terkait dengan produk
            $images = $product->images;
            // URL gambar default jika produk tidak memiliki gambar
            $defaultImageUrl = 'https://cdn.eraspace.com/media/catalog/product/i/p/ipad_gen_10_10_9_inci_wi-fi_cellular_pink_1.jpg';
            // URL gambar pertama, atau default jika tidak ada gambar yang tersedia
            $imageUrl = isset($images[0]) ? $images[0]->img_url : $defaultImageUrl;
            // Ubah format harga
            $formattedPrice = 'Rp ' . number_format($product->g_original_price, 0, ',', '.');
        @endphp

    <div class="recommendation-card bg-gray-100 rounded-lg p-4 flex flex-col justify-between">
        <img src="{{ $imageUrl }}" alt="{{ $product->g_name }}" class="w-full mb-2">
        <h3 class="mb-1 text-xl font-semibold">{{ $product->g_name }}</h3>
        <p class="mb-1 text-lg">Price: {{ $formattedPrice }}</p>
        <p class="mb-4 text-lg">Category: {{ $product->g_category }}</p>
        <button class="bg-purple-500 text-white px-6 py-3 rounded hover:bg-gray-600 transition duration-300" onclick="startBarter()">Click to Barter</button>
    </div>
    @endforeach
        </div>
    </div>

        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
             // Get the wishlist from the local storage
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

// Function to remove a product from the wishlist
function removeFromWishlist(index) {
    Swal.fire({
        title: "Do you want to remove this product from the wishlist?",
        showDenyButton: true,
        confirmButtonText: "Remove",
        denyButtonText: `Cancel`
    }).then((result) => {
        if (result.isConfirmed) {
            wishlist.splice(index, 1); // Remove the product from the wishlist array based on the index
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            displayWishlist(); // Update the wishlist view after removing the product
            // Update the wishlist count
            const wishlistCount = document.getElementById('wishlist-count');
            wishlistCount.textContent = wishlist.length;
            Swal.fire("Removed!", "", "success");
        } else if (result.isDenied) {
            Swal.fire("Cancelled", "", "error");
        }
    });
}

// Function to add a product to the wishlist
function addToWishlist(id, name, price, image, type) {
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    // Check if the product already exists in the wishlist
    const isProductInWishlist = wishlist.some(product => product.productId === id);

    if (isProductInWishlist) {
        Swal.fire("Product already exists in Wishlist!");
    } else {
        // Add the product to the wishlist
        wishlist.push({ productId: id, name, price, image, type });
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        displayWishlist(); // Update the wishlist view after adding the product
        // Update the wishlist count
        const wishlistCount = document.getElementById('wishlist-count');
        wishlistCount.textContent = wishlist.length;
        Swal.fire("Product added to the Wishlist!", "", "success");

        // Send AJAX request to server to add product to wishlist
        addToWishlistBackend(id);
    }
}

// Function to send AJAX request to server to add product to wishlist
function addToWishlistBackend(productId) {
    // Send AJAX request
    fetch('/wishlist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token
        },
        body: JSON.stringify({
            product_id: productId,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Product added to wishlist in backend');
        } else {
            console.error('Failed to add product to wishlist in backend');
        }
    })
    .catch(error => {
        console.error('Error adding product to wishlist in backend:', error);
    });
}



// Function to display the wishlist
function displayWishlist() {
    const productList = document.querySelector('.grid');
    productList.innerHTML = ''; // Clear the product view before adding new products

    if (wishlist.length === 0) {
        productList.innerHTML = '<p class="col-span-full text-center">No products in the wishlist.</p>';
        return;
    }

    wishlist.forEach((product, index) => {
        const productCard = document.createElement('div');
        productCard.classList.add('bg-pink-100', 'rounded-lg', 'p-4', 'flex', 'flex-col', 'justify-between');
        productCard.dataset.index = index; // Store the index as dataset

        const image = document.createElement('img');
        image.src = product.image;
        image.alt = product.name;
        image.classList.add('w-full', 'mb-2');

        const name = document.createElement('h3');
        name.textContent = product.name;
        name.classList.add('mb-1', 'text-xl');

        const price = document.createElement('p');
        price.textContent = `Price: ${product.price}`;
        price.classList.add('mb-1', 'text-lg');

        const type = document.createElement('p');
        type.textContent = `Type: ${product.type}`;
        type.classList.add('mb-4', 'text-lg');
        
        const removeButton = document.createElement('button');
        removeButton.classList.add('mt-2', 'px-4', 'py-2', 'rounded-md', 'bg-red-600', 'text-white', 'border', 'border-transparent', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-red-600', 'focus:ring-opacity-50');
        removeButton.textContent = 'Remove from Wishlist';
        removeButton.addEventListener('click', () => removeFromWishlist(index)); // Use the index as parameter for removeFromWishlist()

        productCard.appendChild(image);
        productCard.appendChild(name);
        productCard.appendChild(price);
        productCard.appendChild(type);
        productCard.appendChild(removeButton);
        productList.appendChild(productCard);
    });
}

// Display the wishlist on page load
displayWishlist();

// Update the wishlist count on page load
const wishlistCount = document.getElementById('wishlist-count');
wishlistCount.textContent = wishlist.length;

        </script>
    </div>
</div>


