@php
// Ambil semua kota dari database
$cities = \App\Models\User::distinct('us_city')->pluck('us_city');
@endphp
<div class="my-10 relative">
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-red-500 mb-4">Recommended Products <span class="text-sm text-gray-600">based
                on location</span></h2>
        <div class="flex gap-2 px-2">
            <select
                class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 mb-4"
                onchange="filterByCity(this.value)">
                <option value="All">All</option>
                @foreach($cities as $city)
                <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
            </select>
        </div>
        <div class="product-slider-container overflow-hidden relative">
            <div class="flex" id="productCards">
                @php
                $products = \App\Models\Goods::getAllGoodsWithImages();
                @endphp
                @foreach($products as $product)
                @php
                // Ambil informasi pengguna yang memiliki produk
                $user = $product->userID;
                @endphp
                <div class="product-card flex-none w-1/4 border border-gray-300 {{ strtolower($user->us_city) }}"
                    data-location="{{ strtolower($user->us_city) }}">
                    <img src="{{ $product->images->first()->img_url ?? 'https://via.placeholder.com/400' }}"
                        alt="Product Image">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->g_name }}</h3>
                        <p class="text-sm text-gray-600">{{ $product->g_desc }}</p>
                        <!-- Tampilkan informasi lokasi pengguna -->
                        <p class="text-sm text-gray-600">Location: {{ $user->us_city }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600 text-xs">Price: Rp {{ number_format($product->g_original_price,
                                0, ',', '.') }}</span>
                            @auth
                            <button
                                class="bg-purple-500 text-white px-4 py-2 ml-2 rounded hover:bg-gray-600 transition duration-300"
                                style="font-size: 14px;"
                                onclick="openModal('{{ $product->g_name }}', '{{ $product->g_desc }}', '{{ $product->images->first()->img_url ?? 'https://via.placeholder.com/400' }}', '{{ $user->us_city }}', '{{ number_format($product->g_original_price, 0, ',', '.') }}', '{{ $product->g_ID }}')">Detail</button>
                            <button
                                class="bg-purple-500 text-white px-4 py-2 ml-1 rounded hover:bg-gray-600 transition duration-300"
                                style="font-size: 14px;">Add</button>
                            @endauth
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
    style="background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; z-index: 1000; top: 0; left: 0; width: 100%; height: 100%; overflow: auto;"
    data-product-id="">
    <div class="modal-content"
        style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 600px; position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <span class="close" onclick="closeModal()"
            style="position: absolute; top: 10px; right: 10px; font-size: 24px; cursor: pointer; color: #888; z-index: 1;">&times;</span>
        <h2 id="modalTitle"
            style="color: #333; text-align: center; font-size: 28px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            Product Details</h2>
        <div style="text-align: center;">
            <img id="modalImage" src="" alt="Product Image"
                style="width: 300px; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
            <p id="modalLocation" style="color: #666; margin-bottom: 10px;"></p>
            <p id="modalPrice" style="color: #666; margin-bottom: 20px; font-size: 18px; font-weight: bold;"></p>
        </div>
        <hr style="margin: 20px 0;"> <!-- Garis penghalang -->
        <p id="modalProductId" style="color: #666; margin-bottom: 10px;"></p>
        <p id="modalDescription" style="color: #666; text-align: justify;"></p>
        <hr style="margin: 20px 0;"> <!-- Garis penghalang -->
        <div id="commentSection" class="mt-4"></div>
        <div
            style="text-align: center; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);">
            <form id="commentFormModal" class="flex items-center justify-center" action="{{ route('comment_store') }}"
                method="POST">
                @csrf
                <!-- Tambahkan input tersembunyi untuk menyimpan g_id -->
                <input type="hidden" id="g_ID" name="g_ID" value="">
                <textarea id="commentInputModal" name="comment"
                    class="w-full px-3 py-2 rounded border-none focus:outline-none focus:border-indigo-500 mr-2"
                    rows="4" placeholder="Add a comment" style="resize: none;"></textarea>
                <button type="submit"
                    class="bg-transparent hover:bg-purple-500 text-purple-500 font-semibold hover:text-white px-4 py-2 border border-purple-500 hover:border-transparent rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 17l5-5m0 0l-5-5m5 5h-12"></path>
                    </svg>
                </button>
            </form>
        </div>
        <div style="text-align: center;">
            <button
                class="bg-purple-500 text-white px-4 py-2 ml-2 rounded hover:bg-gray-600 transition duration-300 mt-2"
                onclick="addToCart()">Add to Cart</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function openModal(name, description, image, location, price, g_ID) {
    const modal = document.getElementById('productModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalImage = document.getElementById('modalImage');
    const modalLocation = document.getElementById('modalLocation');
    const modalPrice = document.getElementById('modalPrice');
    const modalProductId = document.getElementById('modalProductId');

    modal.style.display = 'block';
    modalTitle.textContent = name;
    modalDescription.textContent = description;
    modalImage.src = image;
    modalLocation.textContent = "Location: " + location;
    modalPrice.textContent = "Price: " + price;
    modalProductId.textContent = "Product ID: " + g_ID;

    // Set nilai g_ID di input tersembunyi untuk formulir komentar
    document.getElementById('g_ID').value = g_ID; // Atur g_ID sesuai dengan produk yang terbuka

    // Load comments based on the g_ID of the current product
    loadComments(g_ID);
}

function loadComments(g_ID) {
    axios.get('/comments/' + g_ID)
        .then(function(response) {
            // Clear existing comments
            document.getElementById('commentSection').innerHTML = '';

            // Append retrieved comments to the comment section
            let comments = response.data;
            if (comments.length > 4) {
                // If there are more than 4 comments, display only the first 4
                comments = comments.slice(0, 4);
            }
            
            comments.forEach(function(comment, index) {
                const commentSection = document.getElementById('commentSection');
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('flex', 'items-start', 'mb-4');
                commentDiv.innerHTML = `
                    <img src="profile_picture.jpg" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2">
                    <div>
                        <p class="font-semibold" style="margin-bottom: 4px;">${comment.us_ID}</p>
                        <p class="text-sm text-gray-600" style="margin-bottom: 0;">${comment.comment_desc}</p>
                    </div>
                `;
                commentSection.appendChild(commentDiv);
            });

            // If there are more than 4 comments, add a "Show more" button
            if (response.data.length > 4) {
                const showMoreBtn = document.createElement('button');
                showMoreBtn.textContent = 'Show more';
                showMoreBtn.classList.add('text-blue-500', 'mb-4', 'italic', 'border-b-2', 'border-blue-500', 'hover:border-blue-600'); // Tambahkan kelas Tailwind untuk gaya tambahan
                showMoreBtn.onclick = function() {
                    // Load all comments when "Show more" button is clicked
                    loadAllComments(g_ID);
                    showMoreBtn.style.display = 'none'; // Hide the "Show more" button
                };
                document.getElementById('commentSection').appendChild(showMoreBtn);
            }
        })
        .catch(function(error) {
            console.error('Error fetching comments:', error);
        });
}

// Function to load all comments
function loadAllComments(g_ID) {
    axios.get('/comments/' + g_ID)
        .then(function(response) {
            // Clear existing comments
            document.getElementById('commentSection').innerHTML = '';

            // Append all comments to the comment section
            response.data.forEach(function(comment, index) {
                const commentSection = document.getElementById('commentSection');
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('flex', 'items-start', 'mb-4');
                commentDiv.innerHTML = `
                    <img src="profile_picture.jpg" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2">
                    <div>
                        <p class="font-semibold" style="margin-bottom: 4px;">${comment.us_ID}</p>
                        <p class="text-sm text-gray-600" style="margin-bottom: 0;">${comment.comment_desc}</p>
                    </div>
                `;
                commentSection.appendChild(commentDiv);
            });
        })
        .catch(function(error) {
            console.error('Error fetching comments:', error);
        });
}


// Function to close modal
function closeModal() {
    var modal = document.getElementById('productModal');
    modal.style.display = "none";
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById('productModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Ambil elemen slide dan tombol
const productSlider = document.querySelector('.product-slider-container');
const slideLeftBtn = document.querySelector('.product-slider-btn.left-0');
const slideRightBtn = document.querySelector('.product-slider-btn.right-0');
const productCards = document.querySelectorAll('.product-card');
const cardWidth = productCards[0].offsetWidth + parseInt(getComputedStyle(productCards[0]).marginLeft) + parseInt(getComputedStyle(productCards[0]).marginRight);
const visibleCards = 4;
let startIndex = 0;
let endIndex = visibleCards - 1;
let filteredProducts = [];

// Panggil fungsi resetIndexes saat struktur HTML lengkap dimuat
window.addEventListener('load', resetIndexes);

// Fungsi untuk mengatur ulang indeks awal dan akhir setelah struktur HTML lengkap dimuat
function resetIndexes() {
    endIndex = visibleCards - 1;
    showHideCards(filteredProducts);
}

// Fungsi untuk menampilkan atau menyembunyikan kartu produk berdasarkan indeks
function showHideCards(cards) {
    cards.forEach((card, index) => {
        if (index >= startIndex && index <= endIndex) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function slideLeft() {
    if (startIndex > 0) {
        startIndex--;
        endIndex--;
        productSlider.scrollLeft -= cardWidth;
        showHideCards(filteredProducts);
    }
}

// Fungsi untuk menggeser slide ke kanan
function slideRight() {
    if (endIndex < {{ count($products) }} - 1) {
        startIndex++;
        endIndex++;
        productSlider.scrollLeft += cardWidth;
        showHideCards(filteredProducts);
    }
}

function filterByCity(location) {
    // Loop melalui setiap produk
    productCards.forEach(card => {
        // Ambil lokasi pengguna yang terkait dengan produk
        const cardLocation = card.getAttribute('data-location');

        // Periksa apakah lokasi pengguna cocok dengan kota yang dipilih atau "All"
        if (location === 'All' || cardLocation.toLowerCase() === location.toLowerCase()) {
            card.style.display = 'block'; // Tampilkan produk jika cocok
        } else {
            card.style.display = 'none'; // Sembunyikan produk jika tidak cocok
        }
    });
    resetIndexes(); // Atur ulang indeks untuk slider
}

// Prevent the default form submission behavior and use AJAX instead
document.getElementById('commentFormModal').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    const formData = new FormData(this); // Get form data
    axios.post(this.action, formData) // Submit form data via AJAX
        .then(function(response) {
            // Reload comments after successful submission
            loadComments(formData.get('g_ID'));
        })
        .catch(function(error) {
            console.error('Error submitting comment:', error);
        });
});
</script>