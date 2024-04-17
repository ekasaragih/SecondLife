@include('utils.layouts.navbar.topnav')

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
                            <a href="{{ route('my_goods') }}" title="My Goods"
                                class="p-3 text-center flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My Goods
                            </a>
                            <a href="" title="My Wishlist"
                                class="p-3 text-center flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My Wishlist
                            </a>
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
                                class="ml-2 opacity-75 hover:text-secondary cursor-pointer transition-all ease-out duration-300"
                                title="Change location" id="editLocationButton" data-modal-target="modalChangeAddress"
                                data-modal-toggle="modalChangeAddress">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @include('utils.user.modalEditProfile')
            @include('utils.user.modalChangeAddress')
            @include('utils.user.modalUpdateAvatar')
        </div>
    </div>
</div>

@include('utils.layouts.footer.footer')



{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    import {
        Modal
    } from 'flowbite';
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

    function setProfileData(name, email, role, passwordUpdated, avatar) {
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
                    setProfileData(response.data.name, response.data.email, response.data.role_name,
                        response.data.password_updated_at, response.data.avatar);

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

    function addAvatar() {
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
                    setProfileData(response.data.name, response.data.email, response.data.role_name,
                        response.data.password_updated_at, response.data.avatar);

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

    function loadUserDetail() {
        $.ajax({
            url: '/api/profile/show',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.data) {
                    setProfileData(response.data.name, response.data.email, response.data.role_name,
                        response.data.password_updated_at, response.data.avatar);

                    $('#user_avatar').attr('src', response.avatar_url ||
                        'https://img.icons8.com/bubbles/100/000000/user.png');
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
