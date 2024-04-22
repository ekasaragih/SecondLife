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
            <h3 class="mb-1 text-x  l font-semibold">{{ $product->g_name }}</h3>
            <p class="mb-1 text-lg">Price: {{ $formattedPrice }}</p>
            <p class="mb-4 text-lg">Category: {{ $product->g_category }}</p>
            <button class="bg-purple-500 text-white px-6 py-3 rounded hover:bg-gray-600 transition duration-300" onclick="openProductModal('{{ $product->g_name }}', '{{ $product->g_desc }}', '{{ $imageUrl }}', '{{ $product->g_category }}', '{{ $product->g_type }}', '{{ $formattedPrice }}')">View Details</button></div>
                @endforeach
            </div>
        </div>

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
                <img id="productImage" src="" alt="Product Image" style="max-width: 50%; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
                <h2 id="productName" class="text-2xl font-semibold mb-4"></h2>
                <p id="productDesc" class="text-lg text-gray-700 mb-4"></p>
                <p id="productCategory" class="text-lg text-gray-700 mb-2"></p>
                <p id="productType" class="text-lg text-gray-700 mb-2"></p>
                <p id="productPrice" class="text-lg text-gray-700 mb-2"></p>
                <div class="flex justify-center">
                <button class="bg-purple-500 text-white px-6 py-3 rounded hover:bg-gray-600 transition duration-300" onclick="showTermsAndConditionsPopup()">Click to Barter</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Popup Terms and Conditions -->
    <div id="termsModal" class="modal" style="background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; z-index: 1100; top: 0; left: 0; width: 100%; height: 100%; overflow: auto;">
            <div class="modal-content" style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 800px; /* Ubah nilai max-width di sini */ position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                <div class="flex justify-end p-4">
                    <button class="text-gray-500 hover:text-gray-600 focus:outline-none" onclick="closeTermsModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        @include('utils.layouts.footer.footer')

        <style>
            .wide-popup {
                width: 1400px !important; 
            }
        </style>
        
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
function addToWishlist(id, name, desc, price, image, type) {
    // Check if the product already exists in the wishlist
    const isProductInWishlist = wishlist.some(product => product.productId === id);

    if (isProductInWishlist) {
        Swal.fire("Product already exists in Wishlist!");
    } else {
        // Add the product to the wishlist
        wishlist.push({ productId: id, name, desc, price, image, type });
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

            const desc = document.createElement('h3');
            desc.textContent = product.desc;
            desc.classList.add('mb-1', 'text-xl');

            const category = document.createElement('h3');
            category.textContent = product.category;
            category.classList.add('mb-1', 'text-xl');

            const type = document.createElement('p');
            type.textContent = `Type: ${product.type}`;
            type.classList.add('mb-4', 'text-lg');

            const price = document.createElement('p');
            price.textContent = `Price: ${product.price}`;
            price.classList.add('mb-1', 'text-lg');

            const viewDetailsButton = document.createElement('button');
            viewDetailsButton.classList.add('bg-purple-500', 'text-white', 'px-6', 'py-3', 'rounded', 'hover:bg-gray-600', 'transition', 'duration-300');
            viewDetailsButton.textContent = 'View Details';
            viewDetailsButton.onclick = function() {
                openProductModal(
                    `{{ $product->g_name }}`,
                    `{{ $product->g_desc }}`,
                    `{{ $imageUrl }}`,
                    `{{ $product->g_category }}`,
                    `{{ $product->g_type }}`,
                    `{{ $formattedPrice }}`
                );
            };

            const removeButton = document.createElement('button');
            removeButton.classList.add('mt-2', 'px-4', 'py-2', 'rounded-md', 'bg-red-600', 'text-white', 'border', 'border-transparent', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-red-600', 'focus:ring-opacity-50');
            removeButton.textContent = 'Remove from Wishlist';
            removeButton.addEventListener('click', () => removeFromWishlist(index));

            productCard.appendChild(image);
            productCard.appendChild(name);
            productCard.appendChild(desc);
            productCard.appendChild(category);
            productCard.appendChild(type);
            productCard.appendChild(price);
            productCard.appendChild(viewDetailsButton);
            productCard.appendChild(removeButton);
            productList.appendChild(productCard);
        });
    }

    // Display the wishlist on page load
    displayWishlist();

    // Open Product Modal
    function openProductModal(name, desc, image, category, type, price) {
    document.getElementById('productName').textContent = name;
    document.getElementById('productDesc').textContent = desc;
    document.getElementById('productImage').src = image; 
    document.getElementById('productCategory').textContent = 'Category: ' + category;
    document.getElementById('productType').textContent = 'Type: ' + type;
    document.getElementById('productPrice').textContent = 'Price: ' + price;
    document.getElementById('productModal').style.display = 'block';
}   

    // Close Product Modal
    function closeProductModal() {
        document.getElementById('productModal').style.display = 'none';
    }

    // Update the wishlist count on page load
    const wishlistCount = document.getElementById('wishlist-count');
    wishlistCount.textContent = wishlist.length;

       // Function to show Terms and Conditions popup
       function showTermsAndConditionsPopup(name, desc) {
                // Tampilkan popup Terms and Conditions
                Swal.fire({
                    title: '<span style="font-size: 20px; font-weight: bold;">Barter Process Terms & Conditions</span>',
                    html: '<div style="text-align: justify; font-size: 16px; font-weight: 370;">' +
                        '<p>Dear User,</p><br>' +
                        '<p>Welcome to Secondlife, your trusted platform for facilitating barter transactions. Before proceeding, it\'s important to familiarize yourself with our terms and conditions to ensure a smooth and fair bartering experience for all participants.</p><br>' +
                        '<ul>' +
                            '<li><strong>1. Accuracy of Listings:</strong> Users are required to provide accurate and truthful descriptions of the items or services they offer for barter. Misrepresentation of items or services may result in the suspension or termination of the user\'s account.</li>' +
                            '<li><strong>2. Open Communication:</strong> We encourage open and transparent communication between users regarding the terms of the barter agreement. It is essential to discuss the condition, quantity, and value of the items or services being exchanged to avoid misunderstandings.</li>' +
                            '<li><strong>3. Legal Compliance:</strong> Users must ensure that the items or services they offer for barter comply with all applicable laws and regulations. This includes, but is not limited to, laws related to the sale of goods, intellectual property rights, and taxation.</li>' +
                            '<li><strong>4. Dispute Resolution:</strong> In the event of a dispute between users regarding a barter transaction, users are encouraged to attempt to resolve the issue amicably. If a resolution cannot be reached, users may contact the website administrator for assistance.</li>' +
                            '<li><strong>5. Limitation of Liability:</strong> The website and its administrators are not responsible for any disputes, damages, or losses arising from the barter process. Users engage in barter transactions at their own risk.</li>' +
                            '<li><strong>6. Privacy and Data Protection:</strong> We are committed to protecting your privacy and handling your personal information with care. All personal data provided during the barter process will be handled in accordance with our privacy policy. Users are prohibited from sharing personal information of other users without their consent.</li>' +
                            '<li><strong>7. Modification of Terms:</strong> These terms and conditions may be modified or updated by the website administrator at any time. Users will be notified of any changes, and continued use of the website constitutes acceptance of the modified terms.</li>' +
                            '<li><strong>8. Termination of Service:</strong> The website administrator reserves the right to suspend or terminate the barter service or any user\'s account at any time, for any reason, without prior notice.</li>' +
                            '<li><strong>9. Governing Law and Jurisdiction:</strong> These terms and conditions are governed by the laws of jurisdiction. Any disputes arising from the barter process shall be resolved exclusively in the courts of jurisdiction].</li>' +
                            '<li><strong>10. Severability:</strong> If any provision of these terms and conditions is found to be invalid or unenforceable, the remaining provisions shall remain in full force and effect.</li><br>' +
                        '</ul>' +
                        '<p>By continuing to use our website and participate in the barter process, you acknowledge that you have read, understood, and agree to abide by these terms and conditions.</p><br>' +
                        '<p>Thank you for choosing Secondlife for your bartering needs. Should you have any questions or concerns, please do not hesitate to contact us.</p><br>' +
                        '<p>Sincerely,</p>' +
                        '<p>Secondlife Team</p>' +
                    '</div>', 
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'I Accept',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        popup: 'wide-popup' // Tambahkan kelas CSS wide-popup di sini
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna menerima, lanjutkan dengan aksi yang diinginkan, misalnya lanjut ke obrolan
                        continueToChat();
                    } else {
                        // Jika pengguna membatalkan atau menolak, tutup popup atau lakukan aksi lain yang sesuai
                        closeProductModal();
                    }
                });
            }
        </script>
    </div>
</div>
