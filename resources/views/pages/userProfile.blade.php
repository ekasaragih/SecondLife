@include('utils.layouts.navbar.topnav')

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
@endsection

<div class="pt-52 mb-24">

    <div class="mx-12 bg-white rounded-lg overflow-hidden shadow-lg">
        <div class="border-b p-4">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-1">
                    <div class="text-center">
                        <img class="h-32 w-32 rounded-full border-4 border-white mx-auto"
                            src="https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg" alt="">
                        <button
                            class="mb-5 py-2.5 px-3 text-sm font-medium text-primary focus:outline-none bg-gray-50 rounded-lg border border-primary hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-4 focus:ring-primary"
                            onclick="loadAddAvatarModal()" data-modal-target="modalUpdateAvatar"
                            data-modal-toggle="modalUpdateAvatar" type="button">Update
                            Avatar</button>


                        <div class="flex gap-2 px-2">
                            <button
                                class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My Goods
                            </button>
                            <button
                                class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My wishlist
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 m-5 flex flex-col justify-center">
                    <div class="text-3xl font-bold">Ocha Rara Jiji Wini
                        <span
                            class="ml-2 opacity-75 hover:text-secondary cursor-pointer transition-all ease-out duration-300"
                            title="Edit profile" id="editProfileButton" data-modal-target="modalEditProfile"
                            data-modal-toggle="modalEditProfile">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="text-primary">@charajiwin</div>
                    <a href="#" class="text-gray-500 underline text-sm mt-2 italic">Change password</a>
                    <div class="py-2 mt-5">
                        <div class="inline-flex text-gray-700 items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-1" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class=""
                                    d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                            </svg>
                            New York, NY
                            <span
                                class="ml-2 opacity-75 hover:text-secondary cursor-pointer hover:transition-all hover:ease-out hover:duration-300"
                                title="Change address" id="changeAddressButton">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @include('utils.user.modalEditProfile')
            @include('utils.user.modalChangeAddress')

        </div>
    </div>
</div>

@include('utils.layouts.footer.footer')

<div id="modalUpdateAvatar" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Update Avatar
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modalUpdateAvatar">
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
                <div class="m-3">
                    <label for="formFileSm" class="block mb-2 text-sm font-medium text-gray-900">Choose image</label>
                    <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="upload_avatar" type="file" accept="image/*">
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="default-modal" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Update</button>
                <button data-modal-hide="default-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    import { Modal } from 'flowbite';

    document.addEventListener("DOMContentLoaded", function () {
        const editProfileButton = document.getElementById("editProfileButton");
        const changeAddressButton = document.getElementById("changeAddressButton");        
        const editProfileCollapseMenu = document.getElementById("editProfileCollapseMenu");
        const changeAddressCollapseMenu = document.getElementById("changeAddressCollapseMenu");

         editProfileButton.addEventListener("click", function () {
            editProfileCollapseMenu.classList.toggle("hidden");
            changeAddressCollapseMenu.classList.add("hidden");
        });

        changeAddressButton.addEventListener("click", function () {
            changeAddressCollapseMenu.classList.toggle("hidden");
            editProfileCollapseMenu.classList.add("hidden");
        });
    });
</script>

<script>
    function loadUpdateProfileModal() {
        $('#modalUpdateProfile').modal('show');
        $('#input_name').val($('#user_name').text());
        $('#input_email').val($('#user_email').text());
        $('#input_password').val('');
        $('#input_confirm_password').val('');
    }

    function loadAddAvatarModal() {
        $('#modalAddAvatar').modal('show');
        $('#upload_avatar').val('');
    }

    function setProfileData(name, email, role, passwordUpdated, avatar){
        console.log(name + " " + email + " " + role + " " + passwordUpdated + " " + avatar);
        $('#user_name').text(name);
        $('#user_email').text(email);
        $('#user_role').text(role);
        $('#user_password_updated_at').text(moment(passwordUpdated).fromNow());
        $('#user_avatar').attr('src', "{{ url('storage/avatars') }}" + '/' + avatar);
    }

    function updateProfile() {
        var formData = new FormData();
        formData.append('name', $('#input_name').val());
        formData.append('email', $('#input_email').val());
        formData.append('password', $('#input_password').val());
        formData.append('password_confirmation', $('#input_confirm_password').val());

        $.ajax({
            url: '/api/profile/update',
            method: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response && response.data) {
                    setProfileData(response.data.name, response.data.email, response.data.role_name, response.data.password_updated_at, response.data.avatar);

                    $('#modalUpdateProfile').modal('hide');

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    console.error('Error: Failed to update user profile data');
                }
            },
            error: function(xhr, status, error) {
                alert(error);
                console.error('Error:', error);
            }
        });
    }

    function addAvatar(){
        var formData = new FormData();
        formData.append('name', $('#user_name').text());
        formData.append('email', $('#user_email').text());
        formData.append('avatar', $('#upload_avatar')[0].files[0]);

        console.log($('#upload_avatar')[0].files[0]);

        $.ajax({
            url: '/api/profile/update',
            method: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response && response.data) {
                    setProfileData(response.data.name, response.data.email, response.data.role_name, response.data.password_updated_at, response.data.avatar);

                    $('#modalAddAvatar').modal('hide');

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    console.error('Error: Failed to update user avatar');
                }
            },
            error: function(xhr, status, error) {
                alert(error);
                console.error('Error:', error);
            }
        });
    }

    function loadUserDetail(){
        $.ajax({
            url: '/api/profile/show',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.data) {
                    setProfileData(response.data.name, response.data.email, response.data.role_name, response.data.password_updated_at, response.data.avatar);

                    $('#user_avatar').attr('src', response.avatar_url || 'https://img.icons8.com/bubbles/100/000000/user.png');
                } else {
                    console.error('Error: Failed to retrieve user profile data');
                }
            },
            error: function(xhr, status, error) {
                alert(error)
                console.error('Error:', error);
            }
        });
    }

    $(document).ready(function() {
        loadUserDetail();
    });
</script>