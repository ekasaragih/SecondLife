<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .wide-popup {
            width: 1500px !important;
        }
    </style>
</head>

{{-- Filter based on categories --}}
<div class="flex gap-2 px-2">
    <select
        class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
        onchange="filterByCategory(this.value)">
        <option value="All">All</option>
        @foreach ($categories as $category)
        <option value="{{ $category }}">{{ $category }}</option>
        @endforeach
    </select>
</div>

<br>

{{-- Products based on categories --}}
<div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-4 gap-2">
    @foreach ($products as $product)
    <div class="max-w-md rounded overflow-hidden shadow-lg product-card" style="display: block; height: 550px;">
        @php
        $images = $product->images;
        $defaultImageUrl =
        'https://cdn.eraspace.com/media/catalog/product/i/p/ipad_gen_10_10_9_inci_wi-fi_cellular_pink_1.jpg';
        $imageUrl = isset($images[0]) ? $images[0]->img_url : $defaultImageUrl;
        $formattedPrice = 'Rp ' . number_format($product->g_original_price, 0, ',', '.');
        @endphp

        <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image">
        <div class="px-6 py-4">
            <input type="hidden" id="goods_owner" value="{{ $product->us_ID }}" />
            <div class="font-bold text-xl mb-2">{{ $product->g_name }}</div>
            <p class="text-gray-700 text-base mb-2">{{ $product->g_desc }}</p>
            <div class="grid grid-cols-1 gap-2">
                <div>
                    {{-- <input type="hidden" id="goods_owner" value="{{ $product->us_ID }}" /> --}}
                    <p class="text-gray-700"><span class="font-bold">Category:</span> {{ $product->g_category }}</p>
                    <p class="text-gray-700"><span class="font-bold">Condition:</span> {{ $product->g_type }}</p>
                    <p class="text-gray-700"><span class="font-bold">Age:</span> {{ $product->g_age }}</p>
                    <p class="text-gray-700"><span class="font-bold">Price:</span> {{ $formattedPrice }}</p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4">
            <div class="flex justify-between items-center">
                <button class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300"
                    onclick="openProductModal('{{ $product->g_name }}', '{{ $product->g_desc }}', '{{ $imageUrl }}', '{{ $product->g_category }}', '{{ $product->g_type }}', '{{ $formattedPrice }}')">
                    View Details
                </button>
                <button
                    class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300 add-to-wishlist"
                    id="btn_add_wishlist" data-product-id="{{ $product->g_ID }}" data-user-id="{{ $user->us_ID }}">
                    Add to Wishlist
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>

<br><br>

{{-- Product Modal --}}
<div id="productModal" class="modal"
    style="background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; z-index: 1000; top: 0; left: 0; width: 100%; height: 100%; overflow: auto;">
    <div class="modal-content"
        style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 600px; position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <div class="flex justify-end p-4">
            <button class="text-gray-500 hover:text-gray-600 focus:outline-none" onclick="closeProductModal()">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div class="p-8" style="text-align: center;">
            <img id="productImage" src="" alt="Product Image"
                style="max-width: 50%; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
            <h2 id="productName" class="text-2xl font-semibold mb-4"></h2>
            <p id="productDesc" class="text-lg text-gray-700 mb-4"></p>
            <p id="productCategory" class="text-lg text-gray-700 mb-2"></p>
            <p id="productType" class="text-lg text-gray-700 mb-2"></p>
            <p id="productPrice" class="text-lg text-gray-700 mb-2"></p>
            <div class="flex justify-center">
                <button class="bg-purple-500 text-white px-6 py-3 rounded hover:bg-gray-600 transition duration-300"
                    onclick="showTermsAndConditionsPopup()">Click to Barter</button>
            </div>
        </div>
    </div>
</div>

{{-- Recommendation based on Categories --}}
<div class="space-y-2 space-x-2">
    <div class="text-3xl text-[#F12E52]"><b>Recommendation</b><span class="font-bold text-sm text-gray-600">based on
            your preferences</span></div>
</div>
<br>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-4">
        @php
        // Ambil daftar produk yang tidak termasuk dalam wishlist
        $nonWishlistProducts = \App\Models\Goods::all()
        ->filter(function ($product) {
        return !in_array(
        $product->id,
        collect(json_decode(request()->cookie('wishlist') ?? '[]'))
        ->pluck('id')
        ->toArray(),
        );
        })
        ->shuffle()
        ->take(8);
        @endphp

        @foreach ($nonWishlistProducts as $product)
        <div class="recommendation-card bg-gray-100 rounded-lg p-4 flex flex-col justify-between">
            <img src="{{ $product->images->first()->img_url ?? 'https://via.placeholder.com/150' }}"
                alt="{{ $product->g_name }}" class="w-full mb-2">
            <h3 class="mb-1 text-xl font-semibold">{{ $product->g_name }}</h3>
            <p class="mb-1 text-lg">Price: Rp {{ number_format($product->g_original_price, 0, ',', '.') }}</p>
            <p class="mb-4 text-lg">Category: {{ $product->g_category }}</p>
            <button
                class="bg-purple-500 text-white px-2 py-2 rounded hover:bg-gray-600 transition duration-300 btn-add-to-wishlist"
                data-product="{{ $product->g_ID }}" data-user-id="{{ $user->us_ID }}">
                Add to Wishlist
            </button>
        </div>
        @endforeach
    </div>
</div>

<!-- Popup Terms and Conditions -->
<div id=" termsModal" class="modal"
    style="background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; z-index: 1100; top: 0; left: 0; width: 100%; height: 100%; overflow: auto;">
    <div class="modal-content"
        style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 800px; /* Ubah nilai max-width di sini */ position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <div class="flex justify-end p-4">
            <button class="text-gray-500 hover:text-gray-600 focus:outline-none" onclick="closeTermsModal()">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>



<script>
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

    $('#btn_add_wishlist').click(function(e) {
        const productId = this.getAttribute('data-product-id');
        const userId = this.getAttribute('data-user-id');

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
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    });
  
</script>

<script>
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

    // Function to show Terms and Conditions popup
    function showTermsAndConditionsPopup() {
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

    const wishlistCount = document.getElementById('wishlist-count');

    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    wishlistCount.textContent = wishlist.length;

    const removeButtons = document.querySelectorAll('.remove-button');
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.dataset.index;
            wishlist = wishlist.filter(item => item.index !== index);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            wishlistCount.textContent = wishlist.length;
        });
    });

    // Function to continue to the chat page
    function continueToChat() {
        const loggedInUserId = "{{ $user->us_ID }}";
        const ownerUserId = $('#goods_owner').val();

        console.log(loggedInUserId, ownerUserId);

        window.location.href = '{{ route('home_chat') }}?logged_in_user=' + loggedInUserId + '&owner_user=' +
            ownerUserId;
    }
</script>