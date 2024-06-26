<div id="modalEditProfile" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 overflow-y-auto bg-black bg-opacity-50 z-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h2 class="text-2xl font-bold text-[#F12E52]">Update Profile</h2>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modalEditProfile">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="editProfileForm">
                <div class="p-4 md:p-5 space-y-4">
                    <div class="max-w-2xl px-4 py-8 mx-auto">
                        <div>
                            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                                <div class="sm:col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Full
                                        Name</label>
                                    <input type="text" name="us_name" id="input_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        value="{{ $user->us_name }}" placeholder="Type full name" required=""
                                        autocomplete="off" autofocus>
                                </div>
                                <div class="w-full">
                                    <label for="username"
                                        class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                    <input type="text" name="us_username" id="input_username"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        value="{{ $user->us_username }}" placeholder="Type username" required=""
                                        autocomplete="off">
                                </div>
                                <div class="w-full">
                                    <label for="age" class="block mb-2 text-sm font-medium text-gray-900">Date of
                                        Birth</label>
                                    <input type="date" name="us_DOB" id="input_DOB"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        value="{{ $user->us_DOB }}" required="" autocomplete="off">
                                </div>
                                <div class="w-full">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                    <input type="email" name="us_email" id="input_email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        value="{{ $user->us_email }}" placeholder="admin@user.com" required=""
                                        autocomplete="off">
                                </div>
                                <div>
                                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                                    <select id="input_gender"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                        <option value="None" {{ $user->us_gender == 'None' ? 'selected' : '' }}>None</option>
                                        <option value="Female" {{ $user->us_gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Male" {{ $user->us_gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Rather not to say" {{ $user->us_gender == 'Rather not to say' ? 'selected' : '' }}>Rather not to say</option>
                                    </select>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" id="btn_edit_profile"
                        class="text-black bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Save
                    </button>
                    <button type="button"
                        class="text-yellow-400 inline-flex items-center hover:text-white border border-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editProfileForm = document.getElementById('editProfileForm');
        const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        $('#btn_edit_profile').click(function(event) {
            event.preventDefault();

            var profile = {
                us_name: $("#input_name").val(),
                us_username: $("#input_username").val(),
                us_DOB: $("#input_DOB").val(),
                us_email: $("#input_email").val(),
                us_gender: $("#input_gender").val(),
            }

            $.ajax({
                url: '{{ route('edit_my_profile') }}',
                type: 'POST',
                data: profile,
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
