@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52]"><b>Wishlist</b></div>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <style>
        .wishlist-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .product-card {
            background-color: pink;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding: 1rem;
            width: calc(33.333% - 1rem);
            height: 100%;
        }

        .product-card img {
            width: 100%;
            height: auto;
            margin-bottom: 0.5rem;
        }

        .product-card h3,
        .product-card p,
        .product-card button {
            margin-top: 0.5rem;
        }

        .remove-button {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            background-color: #F12E52;
            color: white;
            border: none;
            cursor: pointer;
        }

        .remove-button:hover {
            background-color: #e51d42;
        }

        .footer-spacer {
            height: 100px; /* Adjust the height as needed */
        }
    </style>
</head>
<body>
    <div class="wishlist-container">
        <div class="product-list">
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
            const productList = document.querySelector('.product-list');

            // Remove existing products
            productList.innerHTML = '';

            if (wishlist.length === 0) {
                productList.innerHTML = '<p>No products in the wishlist.</p>';
                return;
            }

            wishlist.forEach((product, index) => {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');
                productCard.dataset.index = product.index;

                const image = document.createElement('img');
                image.src = product.image;
                image.alt = product.name;

                const name = document.createElement('h3');
                name.textContent = product.name;

                const price = document.createElement('p');
                price.textContent = `Price: ${product.price}`;

                const type = document.createElement('p');
                type.textContent = `Type: ${product.type}`;

                const removeButton = document.createElement('button');
                removeButton.classList.add('remove-button');
                removeButton.textContent = 'Remove from Wishlist';
                removeButton.addEventListener('click', () => removeFromWishlist(product.index));

                productCard.appendChild(image);
                productCard.appendChild(name);
                productCard.appendChild(price);
                productCard.appendChild(type);
                productCard.appendChild(removeButton);

                productList.appendChild(productCard);
            });

            // Set the height of each product card to the height of the tallest card
            const cardHeights = Array.from(document.querySelectorAll('.product-card'), card => card.offsetHeight);
            const maxHeight = Math.max(...cardHeights);
            document.querySelectorAll('.product-card').forEach(card => card.style.height = `${maxHeight}px`);
        }

        // Display the wishlist on page load
        displayWishlist();
    </script>
</body>
</html>

    </div>
</div>

<br><br>
@include('utils.layouts.footer.footer')