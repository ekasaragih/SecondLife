<div id="modalProductDetail" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 overflow-y-auto bg-black bg-opacity-50 z-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h2 class="text-2xl font-bold text-[#F12E52]">Product Details</h2>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modalProductDetail">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="max-w-3xl px-4 py-8 mx-auto">
                    <img id="productImage" src="" alt="Product Image"
                        style="max-width: 50%; height: auto; margin: 0 auto 20px; display: block; border-radius: 5px;">
                    <p id="goodsId" class="hidden text-lg text-gray-700 mb-4"></p>
                    <p id="productOwnerId" class="hidden text-lg text-gray-700 mb-4"></p>
                    <h2 id="productName" class="text-2xl font-semibold mb-4"></h2>
                    <p id="productDesc" class="text-lg text-gray-700 mb-4"></p>
                    <p id="productCategory" class="text-lg text-gray-700 mb-2"></p>
                    <p id="productType" class="text-lg text-gray-700 mb-2"></p>
                    <p id="productPrice" class="text-lg text-gray-700 mb-2"></p>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center space-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button class="bg-purple-500 text-white px-6 py-3 rounded hover:bg-gray-600 transition duration-300"
                    data-modal-target="modalTermsAndCondition" data-modal-toggle="modalTermsAndCondition">Click to
                    Barter
                </button>
            </div>
        </div>
    </div>
</div>