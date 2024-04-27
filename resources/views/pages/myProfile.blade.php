@extends('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
</head>

<div class="pt-52 mb-24">
    <div class="mx-12 bg-white rounded-lg overflow-hidden shadow-lg">
        <div class="border-b p-4">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-1">
                    <div class="text-center">
                        <img class="h-32 w-32 rounded-full border-4 border-white mx-auto user_avatar" id="user_avatar"
                            src="{{ $user->avatar ? asset('users_img/' . $user->avatar) : 'https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg' }}"
                            alt="{{ $user->us_name }}">
                        <button
                            class="mb-5 py-2.5 px-3 text-sm font-medium text-primary focus:outline-none bg-gray-50 rounded-lg border border-primary hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-4 focus:ring-primary"
                            data-modal-target="modalUpdateAvatar" data-modal-toggle="modalUpdateAvatar"
                            type="button">Update
                            Avatar</button>


                        <div class="flex gap-2 px-2">
                            <a href="{{ route('my_goods') }}" title="My Goods"
                                class="p-3 text-center flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My Goods
                            </a>
                            <a href="{{ route('wishlist') }}" title="My Wishlist"
                                class="p-3 text-center flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My Wishlist
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 m-5 flex flex-col justify-center">
                    <div class="text-3xl font-bold">
                        <span id="full_name">{{ $user->us_name }}</span>
                        <span
                            class="ml-2 opacity-75 hover:text-secondary cursor-pointer transition-all ease-out duration-300"
                            title="Edit profile" id="editProfileButton" data-modal-target="modalEditProfile"
                            data-modal-toggle="modalEditProfile">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="text-primary" id="user_name"><span>@</span>{{ $user->us_username }}</div>
                    <a href="#" class="text-gray-500 underline text-sm mt-2 italic">Change password</a>
                    <div class="py-2 mt-5">
                        <div class="inline-flex text-gray-700 items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-1" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class=""
                                    d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                            </svg>
                            {{ $user->us_city }}, {{ $user->us_province }}
                            <span
                                class="ml-2 opacity-75 hover:text-secondary cursor-pointer transition-all ease-out duration-300"
                                title="Change location" id="editLocationButton" data-modal-target="modalChangeAddress"
                                data-modal-toggle="modalChangeAddress">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>

                    <div class="ml-auto text-right">
                        <p class="text-lg font-semibold text-gray-800 font-rubik">
                            <!-- Menggunakan class `font-rubik` -->
                            Followers: <span class="text-purple-500">{{ auth()->user()->followers()->count() }}</span>
                        </p>
                        <p class="text-lg font-semibold text-gray-800 font-rubik">
                            <!-- Menggunakan class `font-rubik` -->
                            Following: <span class="text-purple-500">{{ auth()->user()->following()->count() }}</span>
                        </p>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="/js/moment.js"></script>
<script>
    import {
        Modal
    } from 'flowbite';
</script>

<script>
    // TO DO LIST
    // EYOY:
    // 1. habis input DOB ato apa gitu, datanya gak ke input ke db
    // 2. selepas ngeupdate user data, data ke update di db, tapi di page profilenya itu gak keubah.. maybe krn sessionnya?
    // function setProfileData(name, username, email, dob, gender, passwordUpdated, avatar){
    //     console.log(name + " " + username + " " + email + " " + dob + " " + gender + " " + passwordUpdated + " " + avatar);
    //     $('#full_name').text(name);
    //     $('#user_name').text(username);
    //     $('#user_email').text(email);
    //     $('#user_password_updated_at').text(moment(passwordUpdated).fromNow());
    //     if (avatar === null) {
    //         $('#user_avatar').attr('src', 'https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg');
    //     } else {
    //         $('#user_avatar').attr('src', "{{ url('storage/avatars') }}" + '/' + avatar);
    //     }

    //     $('#input_name').text(name);
    //     $('#input_username').text(username);
    //     $('#input_DOB').text(dob);
    //     $('#input_email').text(email);
    //     // $('#input_gender').text(gender);
    // }

    // function updateProfile() {
    //     var newName = document.getElementById('input_name').value;
    //     var newUsername = document.getElementById('input_username').value;
    //     var newDOB = document.getElementById('input_DOB').value;
    //     var newEmail = document.getElementById('input_email').value;
    //     var newGender = document.getElementById('input_gender').value;

    //     var data = {
    //         us_name: newName,
    //         us_username: newUsername,
    //         us_DOB: newDOB,
    //         us_email: newEmail,
    //         us_gender: newGender
    //     };

    //     var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //     var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

    //     $.ajax({
    //         url: '/api/profile/update',
    //         type: 'POST',
    //         dataType: 'json',
    //         headers: {
    //         'X-CSRF-TOKEN': csrfToken,
    //         'Authorization': 'Bearer ' + apiToken
    //         },
    //         data: data,
    //         success: function(response) {
    //             setProfileData(response.data.us_name, response.data.us_username, response.data.us_email, response.data.us_DOB,
    //             response.data.us_gender, response.data.password_updated_at, response.data.avatar);

    //             const modal = new Modal(document.getElementById('modalEditProfile'));
    //             modal.hide();

    //             Swal.fire({
    //                 position: "top-end",
    //                 icon: "success",
    //                 title: response.message,
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             });
    //             console.log(response.message);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(xhr.responseText);
    //         }
    //     });
    // }

    // function loadUserDetail(){
    //     $.ajax({
    //         url: '/api/profile/show',
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function(response) {
    //             if (response && response.data) {
    //                 setProfileData(response.data.us_name, response.data.us_username, response.data.us_email, response.data.us_DOB,
    //                 response.data.us_gender, response.data.password_updated_at, response.data.avatar);

    //                 console.log(setProfileData);
    //                 $('#user_avatar').attr('src', response.avatar_url || 'https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg');
    //             } else {
    //                 console.error('Error: Failed to retrieve user profile data');
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             alert(error)
    //             console.error('Error:', error);
    //         }
    //     });
    // }

    // $(document).ready(function() {
    //     loadUserDetail();
    // });

    // Get the wishlist count element
    const wishlistCount = document.getElementById('wishlist-count');
    // Get the wishlist count element
    const wishlistCount = document.getElementById('wishlist-count');

    // Get the wishlist from the local storage
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    // Update the wishlist count
    wishlistCount.textContent = wishlist.length;

    // Add an event listener to the remove button to update the wishlist count
    const removeButtons = document.querySelectorAll('.remove-button');
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.dataset.index;
            wishlist = wishlist.filter(item => item.index !== index);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            wishlistCount.textContent = wishlist.length;
        });
    });
</script>
