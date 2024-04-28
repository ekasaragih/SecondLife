<div id="productModal" class="modal"
    style="background-color: rgba(0, 0, 0, 0.5); display: none; position: fixed; z-index: 1000; top: 0; left: 0; width: 100%; height: 100%; overflow: auto;"
    data-product-id="">
    <div class="modal-content"
        style="background-color: #fff; margin: 15% auto; padding: 20px; border-radius: 10px; max-width: 800px; width: 90%; position: relative; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">

        <span class="close" onclick="closeModal()"
            style="position: absolute; top: 10px; right: 10px; font-size: 24px; cursor: pointer; color: #888; z-index: 1;">&times;</span>
        <h2 id="modalTitle"
            style="color: #333; text-align: center; font-size: 28px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            Product Details</h2>
        <div style="text-align: center;">
            <img id="modalImage" src="" alt="Product Image"
                style="width: 300px; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
            <p id="modalLocation" style="color: #666; margin-bottom: 10px;"></p>
            <p id="modalPrice" style="color: purple; margin-bottom: 20px; font-size: 18px; font-weight: bold;"></p>
        </div>
        <hr style="margin: 20px 0;"> <!-- Garis penghalang -->
        <p id="modalProductId" style="color: #666; margin-bottom: 10px;"></p>
        <div class="mt-4">
            <span class="mr-3 text-gray-500">Uploaded by:</span>
            <a href="#" id="uploadedByLink" class="font-semibold text-fray-400"></a>
        </div>

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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function openModal(name, description, image, location, price, g_ID, us_name) {
    const modal = document.getElementById('productModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalImage = document.getElementById('modalImage');
    const modalLocation = document.getElementById('modalLocation');
    const modalPrice = document.getElementById('modalPrice');
    const modalProductId = document.getElementById('modalProductId');
    const uploadedByLink = document.getElementById('uploadedByLink'); // Ambil elemen tautan

    modal.style.display = 'block';
    modalTitle.textContent = name;
    modalDescription.textContent = description;
    modalImage.src = image;
    modalLocation.textContent = "Location: " + location;
    modalPrice.textContent = "Price: " + price;
    modalProductId.textContent = "Product ID: " + g_ID;
    uploadedByLink.textContent = us_name; // Atur teks nama pengguna
    uploadedByLink.href = "{{ route('userProfile', ['username' => ':username']) }}".replace(':username', us_name); // Tautkan nama pengguna dengan rute userProfile

// Set nilai g_ID di input tersembunyi untuk formulir komentar
document.getElementById('g_ID').value = g_ID; // Atur g_ID sesuai dengan produk yang terbuka

// Load comments based on the g_ID of the current product
loadComments(g_ID,us_name);
}

// Tentukan rute yang akan diarahkan saat tautan diklik
const userProfileRoute = "{{ route('userProfile', ['username' => ':username']) }}";

function loadComments(g_ID, us_name) {
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
                    <p class="font-semibold" style="margin-bottom: 4px;">
                            <a href="${userProfileRoute.replace(':username', comment.us_name)}" class="text-blue-500">${comment.us_name}</a>
                        </p>
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
function loadAllComments(g_ID, us_name) {
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
                    <p class="font-semibold" style="margin-bottom: 4px;">
                            <a href="${userProfileRoute.replace(':username', comment.us_name)}" class="text-blue-500">${comment.us_name}</a>
                        </p>
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