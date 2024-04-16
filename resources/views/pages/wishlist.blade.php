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
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        wishlist = wishlist.filter(item => item.index !== index);
                        localStorage.setItem('wishlist', JSON.stringify(wishlist));
                        displayWishlist();
                        Swal.fire("Removed!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Cancelled", "", "error");
                    }
                });
            }

            // Function to display the wishlist
            function displayWishlist() {
                const productList = document.querySelector('.grid');

                // Remove existing products
                productList.innerHTML = '';

                if (wishlist.length === 0) {
                    productList.innerHTML = '<p class="col-span-full text-center">No products in the wishlist.</p>';
                    return;
                }

                wishlist.forEach((product, index) => {
                    const productCard = document.createElement('div');
                    productCard.classList.add('bg-pink-100', 'rounded-lg', 'p-4', 'flex', 'flex-col', 'justify-between');
                    productCard.dataset.index = product.index;

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
                    removeButton.addEventListener('click', () => removeFromWishlist(product.index));

                     // Get the wishlist count element
                     const wishlistCount = document.getElementById('wishlist-count');

                    // Get the wishlist from the local storage
                    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

                    // Update the wishlist count
                    wishlistCount.textContent = wishlist.length;

                    // Add an event listener to the remove button to update the wishlist count
                    const removeButtons = document.querySelectorAll('.remove-button');
                    removeButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const index = button.dataset.index;
                            wishlist = wishlist.filter(item => item.index !== index);
                            localStorage.setItem('wishlist', JSON.stringify(wishlist));
                            wishlistCount.textContent = wishlist.length;
                        });
                    });

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
        </script>
    </div>
</div>

@include('utils.layouts.footer.footer')
