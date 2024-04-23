@include('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52]"><b>Wishlist</b></div><br>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-4">
                <!-- Products will be added here -->
            </div>
        </div><br>

        {{-- Recommendation based on Categories --}}
        @include('utils.categories.recommendation')

        {{-- Product Details Modal --}}
        @include('utils.categories.modalProductDetail')

        {{-- T&C Modal --}}
        @include('utils.categories.modalTermsAndCondition')

        @include('utils.layouts.footer.footer')


    </div>
</div>

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="/js/moment.js"></script>
<script>
    import {
            Modal
        } from 'flowbite';
</script>

<script>
    // INI BLM BERES
    // function displayWishlist() {
    //     const productList = document.querySelector('.grid');
    //     productList.innerHTML = ''; // Clear the product view before adding new products

    //     if (wishlist.length === 0) {
    //         productList.innerHTML = '<p class="col-span-full text-center">No products in the wishlist.</p>';
    //         return;
    //     }

    //     wishlist.forEach((product, index) => {
    //         const productCard = document.createElement('div');
    //         productCard.classList.add('bg-pink-100', 'rounded-lg', 'p-4', 'flex', 'flex-col', 'justify-between');
    //         productCard.dataset.index = index; // Store the index as dataset

    //         const image = document.createElement('img');
    //         image.src = product.image;
    //         image.alt = product.name;
    //         image.classList.add('w-full', 'mb-2');

    //         const name = document.createElement('h3');
    //         name.textContent = product.name;
    //         name.classList.add('mb-1', 'text-xl');

    //         const desc = document.createElement('h3');
    //         desc.textContent = product.desc;
    //         desc.classList.add('mb-1', 'text-xl');

    //         const category = document.createElement('h3');
    //         category.textContent = product.category;
    //         category.classList.add('mb-1', 'text-xl');

    //         const type = document.createElement('p');
    //         type.textContent = `Type: ${product.type}`;
    //         type.classList.add('mb-4', 'text-lg');

    //         const price = document.createElement('p');
    //         price.textContent = `Price: ${product.price}`;
    //         price.classList.add('mb-1', 'text-lg');

    //         const viewDetailsButton = document.createElement('button');
    //         viewDetailsButton.classList.add('bg-purple-500', 'text-white', 'px-6', 'py-3', 'rounded', 'hover:bg-gray-600', 'transition', 'duration-300');
    //         viewDetailsButton.textContent = 'View Details';
    //         viewDetailsButton.onclick = function() {
    //             openProductModal(
    //                 `{{ $product->g_name }}`,
    //                 `{{ $product->g_desc }}`,
    //                 `{{ $imageUrl }}`,
    //                 `{{ $product->g_category }}`,
    //                 `{{ $product->g_type }}`,
    //                 `{{ $formattedPrice }}`
    //             );
    //         };

    //         const removeButton = document.createElement('button');
    //         removeButton.classList.add('mt-2', 'px-4', 'py-2', 'rounded-md', 'bg-red-600', 'text-white', 'border', 'border-transparent', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-red-600', 'focus:ring-opacity-50');
    //         removeButton.textContent = 'Remove from Wishlist';
    //         removeButton.addEventListener('click', () => removeFromWishlist(index));

    //         productCard.appendChild(image);
    //         productCard.appendChild(name);
    //         productCard.appendChild(desc);
    //         productCard.appendChild(category);
    //         productCard.appendChild(type);
    //         productCard.appendChild(price);
    //         productCard.appendChild(viewDetailsButton);
    //         productCard.appendChild(removeButton);
    //         productList.appendChild(productCard);
    //     });
    // }

    document.addEventListener('DOMContentLoaded', function() {
        displayWishlist();
    });

   
</script>

<script>
    function addToWishlist(productId, userId) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        var data = {
            g_ID: productId,
            us_ID: userId,
        }

        $.ajax({
            url: 'api/wishlist/store',
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Authorization': 'Bearer ' + apiToken
            },
            data: data,
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    if (data.message.includes('already added')) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops...',
                            text: data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    }

    $(document).on('click', '.add-to-wishlist', function() {
        var productId = $(this).data('product-id');
        var userId = $(this).data('user-id');
        addToWishlist(productId, userId);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var detailButtons = document.querySelectorAll('#btn_see_detail');

        detailButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var productName = this.getAttribute('data-product-name');
                var productDesc = this.getAttribute('data-product-desc');
                var productImage = this.getAttribute('data-product-image');
                var productCategory = this.getAttribute('data-product-category');
                var productType = this.getAttribute('data-product-type');
                var productPrice = this.getAttribute('data-product-price');

                document.getElementById('productName').textContent = productName;
                document.getElementById('productDesc').textContent = productDesc;
                document.getElementById('productImage').src = productImage;
                document.getElementById('productCategory').textContent = 'Category: ' + productCategory;
                document.getElementById('productType').textContent = 'Type: ' + productType;
                document.getElementById('productPrice').textContent = 'Price: ' + productPrice;

            });
        });
    });


    // Filter by Category
    function filterByCategory(category) {
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            const productCategoryElement = card.querySelector('p:nth-child(1)');
            if (productCategoryElement) {
                const productCategoryText = productCategoryElement.textContent.trim();
                const categoryIndex = productCategoryText.indexOf('Category:');
                if (categoryIndex !== -1) {
                    const productCategory = productCategoryText.slice(categoryIndex + 'Category:'.length)
                .trim();
                    if (category === 'All' || productCategory.toLowerCase() === category.toLowerCase()) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            }
        });
    }

    // Function to continue to the chat page
    function continueToChat() {
        const loggedInUserId = "{{ $user->us_ID }}";
        const ownerUserId = $('#goods_owner').val();

        console.log(loggedInUserId, ownerUserId);

        window.location.href = '{{ route('home_chat') }}?logged_in_user=' + loggedInUserId + '&owner_user=' +
            ownerUserId;
    }
</script>