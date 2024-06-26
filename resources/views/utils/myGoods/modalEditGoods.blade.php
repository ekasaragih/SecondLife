<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="/asset/css/imgContainer.css">
</head>

<div id="modalEditGoods" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 overflow-y-auto bg-black bg-opacity-50 z-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Save Changes
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modalEditGoods">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form id="editGoodsForm" enctype="multipart/form-data">
                @csrf
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="max-w-5xl px-4 py-8 mx-auto">
                        <div>
                            <input type="hidden" id="edit_g_ID" />
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Name
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="edit_g_name" name="g_name" placeholder="Enter name of goods"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                            </div>
                            <div class="w-full flex">
                                <div class="w-1/2 mb-4 mr-2">
                                    <label for="category" class="block text-sm font-medium text-gray-700">
                                        Category
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="edit_g_category" name="edit_g_category"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                                        <option value="" selected disabled>-- Choose categories --</option>
                                        <option value="Electronics">Electronics</option>
                                        <option value="Clothing and Accessories">Clothing and Accessories</option>
                                        <option value="Home Decor">Home Decor</option>
                                        <option value="Collectibles">Collectibles</option>
                                        <option value="Books and Media">Books and Media</option>
                                        <option value="Tools and Equipment">Tools and Equipment</option>
                                        <option value="Musical Instruments">Musical Instruments</option>
                                        <option value="Sports and Fitness Equipment">Sports and Fitness Equipment
                                        </option>
                                        <option value="Kitchenware">Kitchenware</option>
                                    </select>
                                </div>
                                <div class="w-1/2 mb-4">
                                    <label for="g_type" class="block text-sm font-medium text-gray-700">
                                        Type
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="edit_g_type" name="edit_g_type"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                                        <option value="" selected disabled>-- Choose type --</option>
                                        <option value="New">New</option>
                                        <option value="Used">Used</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full flex space-x-2">
                                <div class="w-full mb-4">
                                    <label for="original_price" class="block text-sm font-medium text-gray-700">
                                        Original Price
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="edit_g_original_price" name="edit_original_price"
                                        placeholder="ex: 500000"
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                </div>
                                <div class="w-full mb-4">
                                    <label for="age_goods" class="block text-sm font-medium text-gray-700">
                                        Age of Goods (In years)
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="edit_g_age" name="edit_age_goods" placeholder="ex: 1"
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                </div>
                                <div class="w-full mb-4">
                                    <label for="prediction_price" class="block text-sm font-medium text-gray-700">
                                        Prediction Price (counted by the system)</label>
                                    <input type="number" id="edit_g_prediction_price" name="edit_prediction_price"
                                        placeholder="will be count by system"
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md" disabled>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Description
                                    <span class="text-red-500">*</span>
                                </label>
                                <textarea id="edit_g_desc" name="description" rows="3"
                                    placeholder="Give a detail explanation of your goods' condition"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">Upload
                                    Image</label>
                                <input type="text" id="existing_images" class="hidden" name="existing_images">
                                <div id="id-input-div" class="input-div mt-2">
                                    <p>Drag & drop photos here or click to browse</p>
                                    <input name="files" id="edit_image" type="file" class="file" multiple="multiple"
                                        accept="image/jpeg, image/png, image/jpg" onchange="editPreviewImage()" />
                                </div>
                                <div id="edit_queuedImages" class="queued-div p-2">
                                    <div id="edit_imagePreviewContainer" class="d-flex flex-wrap mr-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" id="btn_edit_goods"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center addBtn">
                        Save Changes
                    </button>
                    <button type="button" data-modal-hide="modalEditGoods"
                        class="text-yellow-400 inline-flex items-center hover:text-white border border-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Cancel
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editGoodsForm = document.getElementById('editGoodsForm');
        const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        $('#btn_edit_goods').click(function(event) {
            event.preventDefault();
            var predictionPrice = calculatePredictionPrice();

            var goods = {
                g_ID: $("#edit_g_ID").val(),
                g_name: $("#edit_g_name").val(),
                g_desc: $("#edit_g_desc").val(),
                g_type: $("#edit_g_type").val(),
                g_original_price: $("#edit_g_original_price").val(),
                g_price_prediction: predictionPrice,
                g_age: $("#edit_g_age").val(),
                g_category: $("#edit_g_category").val(),

            }

            $.ajax({
                url: '{{ route('edit_my_goods') }}',
                type: 'POST',
                data: goods,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + apiToken
                },
                success: function(response) {
                    console.log('response: ', response);
                    postGoodsImage(response.g_ID);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            });
        });

        function calculatePredictionPrice() {
            var g_type = $("#edit_g_type").val();
            var g_category = $("#edit_g_category").val();
            var g_original_price = parseInt($("#edit_g_original_price").val());
            var g_age = parseInt($("#edit_g_age").val());
            var estimatedPrice;
            if (g_age === 0) {
                estimatedPrice = g_original_price - (0.0286 * g_original_price / 2);
            } else if (g_type === 'New') {
                estimatedPrice = g_original_price - (g_age * (0.0286 * g_original_price));
            } else if (g_type === 'Used') {
                var marginalSalvage, lifeSpan;

                switch (g_category) {
                    case 'Electronics':
                        marginalSalvage = 0.10;
                        lifeSpan = 5.8;
                        break;
                    case 'Clothing and Accessories':
                        marginalSalvage = 0.25;
                        lifeSpan = 5.4;
                        break;
                    case 'Home Decor':
                        marginalSalvage = 0.15;
                        lifeSpan = 10;
                        break;
                    case 'Collectibles':
                        marginalSalvage = 0.04;
                        lifeSpan = null;
                        break;
                    case 'Books and Media':
                        marginalSalvage = 0.20;
                        lifeSpan = 15;
                        break;
                    case 'Tools and Equipment':
                        marginalSalvage = 0.08;
                        lifeSpan = 7.45;
                        break;
                    case 'Musical Instruments':
                        marginalSalvage = 0.06;
                        lifeSpan = null;
                        break;
                    case 'Sports and Fitness Equipment':
                        marginalSalvage = 0.07;
                        lifeSpan = 10;
                        break;
                    case 'Kitchenware':
                        marginalSalvage = 0.05;
                        lifeSpan = 9.9;
                        break;
                    default:
                        throw new Error('Invalid category');
                }

                if (lifeSpan === null) {
                    estimatedPrice = g_original_price - (marginalSalvage * g_original_price / g_age);
                } else {
                    var depreciationExpense = (g_original_price - (g_original_price * marginalSalvage)) /
                        lifeSpan;
                    estimatedPrice = g_original_price - (g_age * depreciationExpense);
                }
            } else {
                throw new Error('Invalid type');
            }

            console.log(estimatedPrice);
            return estimatedPrice;
        }

        function postGoodsImage(goodsId) {
            var goods_img = new FormData();
            var inputImage = document.getElementById('edit_image');

            const existingImages = JSON.parse($('#existing_images').val());

            const existingImageUrls = existingImages.map(image => image.img_url);

            existingImageUrls.forEach(img_url => {
                goods_img.append('existing_images[]', img_url);
            });


            for (var i = 0; i < inputImage.files.length; i++) {
                goods_img.append('files[]', inputImage.files[i]);
            }
            goods_img.append('g_ID', goodsId);

            $.ajax({
                url: '{{ route('add_img') }}',
                type: 'POST',
                data: goods_img,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + apiToken
                },
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data changes successfully!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log(goods_img);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong while storing images!",
                    });
                }
            });
        }
    });

    function editPreviewImage() {
        const input = document.getElementById('edit_image');
        const imagePreviewContainer = document.getElementById('edit_imagePreviewContainer');

        if (input.files && input.files.length > 0) {
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('queued-image-container');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('queued-image');

                    const deleteButton = document.createElement('span');
                    deleteButton.innerHTML = '&times;';
                    deleteButton.classList.add('delete-button');
                    deleteButton.addEventListener('click', function() {
                        imageContainer.remove();
                        console.log("delete in modalEditGoods");
                        // Optionally, you can also send an AJAX request to delete the image from the database here
                    });

                    imageContainer.appendChild(img);
                    imageContainer.appendChild(deleteButton);

                    imagePreviewContainer.appendChild(imageContainer);
                };

                reader.readAsDataURL(file);
            }
        }
    }
</script>