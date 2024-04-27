<div id="modalChangeAddress" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 overflow-y-auto bg-black bg-opacity-50 z-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h2 class="text-2xl font-bold text-[#F12E52]">Update Location</h2>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modalChangeAddress">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="userLocationForm">
                <div class="p-4 md:p-5 space-y-4">
                    <div class="max-w-2xl px-4 py-8 mx-auto">
                        <div>
                            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                                <div class="w-full">
                                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900">
                                        Province
                                    </label>
                                    <input type="text" name="input_province" id="input_province"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        value="{{$user->us_province}}" placeholder="Type address" required="">
                                </div>
                                <div class="w-full">
                                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900">
                                        City
                                    </label>
                                    <input type="text" name="input_city" id="input_city"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        value="{{$user->us_city}}" placeholder="Type address" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" id="btn_user_address"
                        class="text-black bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Save
                    </button>
                    <button type="button" data-modal-hide="modalChangeAddress"
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
        const userLocationForm = document.getElementById('userLocationForm');
        const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        $('#btn_user_address').click(function(event) {
            event.preventDefault();

            var address = {
                us_city: $("#input_city").val(),
                us_province: $("#input_province").val(),
            }

            $.ajax({
                url: '{{ route('edit_my_address') }}',
                type: 'POST',
                data: address,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + apiToken
                },
                success: function(response) {
                    console.log('response: ', response);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data change successfully!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    var response = xhr.responseJSON;
                    var errorMessage = response.message;
                    Swal.fire({
                        icon: "error",
                        title: "Oops..",
                        text: errorMessage,
                    });
                }
            });
        });
    });
</script>