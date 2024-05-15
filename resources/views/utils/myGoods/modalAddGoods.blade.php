<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="/asset/css/imgContainer.css">
</head>

<div id="modalAddGoods" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 overflow-y-auto bg-black bg-opacity-50 z-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Upload Goods
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modalAddGoods">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form id="addGoodsForm" enctype="multipart/form-data">
                @csrf
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="max-w-5xl px-4 py-8 mx-auto">
                        <div>
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Name
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="g_name" name="name" placeholder="Enter name of goods"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                            </div>
                            <div class="w-full flex">
                                <div class="w-1/2 mb-4 mr-2">
                                    <label for="category" class="block text-sm font-medium text-gray-700">
                                        Category
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="g_category" name="category"
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
                                    <select id="g_type" name="g_type"
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
                                    <input type="number" id="original_price" name="original_price"
                                        placeholder="ex: 500000"
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                </div>
                                <div class="w-full mb-4">
                                    <label for="age_goods" class="block text-sm font-medium text-gray-700">
                                        Age of Goods (In years)
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="age_goods" name="age_goods" placeholder="ex: 1"
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                                </div>
                                <div class="w-full mb-4">
                                    <label for="prediction_price"
                                        class="block text-sm font-medium text-gray-700">Prediction
                                        Price</label>
                                    <input type="number" id="prediction_price" name="prediction_price"
                                        placeholder="will be count by system"
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md" disabled>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Description
                                    <span class="text-red-500">*</span>
                                </label>
                                <textarea id="g_description" name="description" rows="3"
                                    placeholder="Give a detail explanation of your goods' condition"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">Upload
                                    Image</label>
                                <div id="id-input-div" class="input-div mt-2">
                                    <p>Drag & drop photos here or click to browse</p>
                                    <input name="files" id="input_image" type="file" class="file" multiple="multiple"
                                        accept="image/jpeg, image/png, image/jpg" onchange="previewImage()" />
                                </div>
                                <div id="queuedImages" class="queued-div p-2">
                                    <div id="imagePreviewContainer" class="d-flex flex-wrap mr-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" id="btn_upload_goods"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center addBtn">
                        Upload
                    </button>
                    <button type="button" data-modal-hide="modalAddGoods"
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

{{-- Function for queued image and remove it and upload photos - POST to DB --}}
<script>
    const queuedImagesArray = [];

    function previewImage() {
        const input = document.getElementById('input_image');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');

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
                        const index = queuedImagesArray.indexOf(file);
                        if (index !== -1) {
                            queuedImagesArray.splice(index, 1);
                        }
                    });

                    imageContainer.appendChild(img);
                    imageContainer.appendChild(deleteButton);

                    imagePreviewContainer.appendChild(imageContainer);

                    queuedImagesArray.push(file);
                };

                reader.readAsDataURL(file);
            }
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addGoodsForm = document.getElementById('addGoodsForm');
        const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        $('#btn_upload_goods').click(function(event) {
            event.preventDefault();
            var predictionPrice = calculatePredictionPrice();

            var goods = {
                g_name: $("#g_name").val(),
                g_desc: $("#g_description").val(),
                g_type: $("#g_type").val(),
                g_original_price: $("#original_price").val(),
                g_price_prediction: predictionPrice,
                g_age: $("#age_goods").val(),
                g_category: $("#g_category").val(),

            }

            $.ajax({
                url: '{{ route('add_my_goods') }}',
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
            var g_type = $("#g_type").val();
            var g_category = $("#g_category").val();
            var g_original_price = parseInt($("#original_price").val());
            var g_age = parseInt($("#age_goods").val());

            if(g_age === 0){
                var predictionPrice = g_original_price - (0.0286 * g_original_price/2);
                return predictionPrice;
            }
            if (g_type === 'New') {
                var predictionPrice = g_original_price - (g_age * (0.0286 * g_original_price));
                return predictionPrice;
            } else if (g_type === 'Used') {
                var marginalSalvage, lifeSpan;

                if (g_category === 'Electronics') {
                    marginalSalvage = 0.10;
                    lifeSpan = 5.8;
                } else if (g_category === 'Clothing and Accessories') {
                    marginalSalvage = 0.25;
                    lifeSpan = 5.4;
                } else if (g_category === 'Home Decor') {
                    marginalSalvage = 0.15;
                    lifeSpan = 10;
                } else if (g_category === 'Collectibles') {
                    marginalSalvage = 0.04;
                    lifeSpan = null; // Assign a value for lifeSpan
                } else if (g_category === 'Books and Media') {
                    marginalSalvage = 0.20;
                    lifeSpan = 15;
                } else if (g_category === 'Tools and Equipment') {
                    marginalSalvage = 0.08;
                    lifeSpan = 7.45;
                } else if (g_category === 'Musical Instruments') {
                    marginalSalvage = 0.06;
                    lifeSpan = null;
                } else if (g_category === 'Sports and Fitness Equipment') {
                    marginalSalvage = 0.07;
                    lifeSpan = 10;
                } else if (g_category === 'Kitchenware') {
                    marginalSalvage = 0.05;
                    lifeSpan = 9.9;
                }

                if (lifeSpan === null) {
                    var predictionPrice = g_original_price - (marginalSalvage * g_original_price / g_age);
                } else {
                    var depreciationExpense = (g_original_price - (g_original_price * marginalSalvage)) /
                        lifeSpan;
                    var predictionPrice = g_original_price - (g_age * depreciationExpense);
                }
                return predictionPrice;
            } else {
                throw new Error('Invalid type');
            }
        }


        function postGoodsImage(goodsId) {
            var goods_img = new FormData();
            var inputImage = document.getElementById('input_image');

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
                        title: "Goods and images stored successfully!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong while storing images!",
                    });
                }
            });
        }
    });
</script>