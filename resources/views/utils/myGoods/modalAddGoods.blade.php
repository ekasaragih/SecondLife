<div id="modalAddGoods" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
class="hidden fixed inset-0 overflow-y-auto bg-black bg-opacity-50 z-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
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
            <form id="addGoodsForm">
                @csrf
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="max-w-2xl px-4 py-8 mx-auto">
                        <div>
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="name" name="name" placeholder="Enter name of goods"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                            </div>
                            <div class="w-full flex">
                                <div class="w-1/2 mb-4 mr-2">
                                    <label for="category"
                                        class="block text-sm font-medium text-gray-700">Category</label>
                                    <select id="category" name="category"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                                        <option value="electronics">Electronics</option>
                                        <option value="clothing">Clothing</option>
                                        <option value="books">Books</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div class="w-1/2 mb-4">
                                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                    <select id="type" name="type"
                                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required>
                                        <option value="new">New</option>
                                        <option value="used">Used</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="w-full flex space-x-2">
                                <div class="w-full mb-4">
                                    <label for="category" class="block text-sm font-medium text-gray-700">Original
                                        Price</label>
                                    <input type="number" id="originalPrice" name="originalPrice"
                                        placeholder="ex: 500000"
                                        class="mt-1 p-2 block border border-gray-300 rounded-md">
                                </div>
                                <div class="w-full mb-4">
                                    <label for="type" class="block text-sm font-medium text-gray-700">Age of Goods -
                                        inyears </label>
                                    <input type="number" id="ageOfGoods" name="ageOfGoods" placeholder="ex: 1"
                                        class="mt-1 p-2 block border border-gray-300 rounded-md">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="3"
                                    placeholder="Give a detail explanation of your goods' condition"
                                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="image" class="block text-sm font-medium text-gray-700">Upload
                                    Image</label>
                                <input
                                    class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="small_size" type="file">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addGoodsForm = document.getElementById('addGoodsForm');

        addGoodsForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Serialize form data
            const formData = new FormData(addGoodsForm);

            // Send AJAX request
            $.ajax({
                url: '{{ route('add_my_goods') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    addGoodsForm.reset();
                    const modalElement = document.getElementById('modalAddGoods');
                    const modal = new Modal(modalElement);
                    modal.hide();
                    Swal.fire({
                        title: "Success!",
                        text: "Data stored successfully!",
                        icon: "success",
                        timer: 2000,
                        timerProgressBar: true,
                        onClose: function() {
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    });
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
    });
</script>
