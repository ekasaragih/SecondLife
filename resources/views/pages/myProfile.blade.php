@extends('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
</head>

<div class="pt-52 mb-5 font-rubik">
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
                            <span class="font-semibold">
                                <a href="#" id="viewFollowersLink" class="text-gray-800 underline">Followers:</a>
                            </span>
                            <span class="text-purple-500"> {{ auth()->user()->followers()->count() }}</span>
                        </p>

                        <p class="text-lg font-semibold text-gray-800 font-rubik">
                            <span class="font-semibold">
                                <a href="#" id="viewFollowingLink" class="text-gray-800 underline">Following:</a>
                            </span>
                            <span class="text-purple-500"> {{ auth()->user()->following()->count() }}</span>
                        </p>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-10 mx-12">
    <div class="flex flex-wrap justify-center gap-7">
        <a href="/my-goods"
            class="flex flex-col w-64 max-w-64 items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/avail.png" alt="" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-primary">
                    Available goods
                </h5>
                <p class="mb-3  text-xl font-semibold text-gray-700 text-center">
                    {{ $availableGoodsCount }}
                </p>
            </div>
        </a>

        <!-- Arrow icon -->
        <div class="flex items-center justify-center">
            <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>

        <a href="/wishlist"
            class="flex flex-col w-64 max-w-64 items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/wishlist.png" alt="" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-primary">
                    Your wishlist
                </h5>
                <p class="mb-3  text-xl font-semibold text-gray-700 text-center">
                    {{ $wishlistCount }}
                </p>
            </div>
        </a>

        <!-- Arrow icon -->
        <div class="flex items-center justify-center">
            <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>

        <a href="/exchange-request"
            class="flex flex-col w-64 max-w-64 items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success.png" alt="" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-primary">
                    Exchange requests
                </h5>
                <p class="mb-3  text-xl font-semibold text-gray-700 text-center">
                    {{ $pendingExchanges }}
                </p>
            </div>
        </a>

        <!-- Arrow icon -->
        <div class="flex items-center justify-center">
            <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>

        <a href="/profile"
            class="flex flex-col w-64 max-w-64 justify-center items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-primary">
                    Bartered goods
                </h5>
                <p class="mb-3  text-xl font-semibold text-gray-700 text-center">
                    {{ $totalBarteredGoods }}
                </p>
            </div>
        </a>
    </div>
</div>

<div class="pt-0 pb-10 font-rubik">
    <div class="mt-10 mx-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-semibold text-purple-600">My Uploaded Goods</h2>
            @if ($user->goods->isEmpty())
            <p class="text-xl text-gray-600">You haven't uploaded any goods yet.</p>
            @else
            <p class="text-base text-gray-800 mb-4">Welcome to your profile. Here's a list of the items you've given a
                second
                chance to. Thank you for bringing these products back to life and giving them another opportunity to
                shine.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                @foreach ($user->goods as $good)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @php
                    $images = $good->images;
                    $defaultImageUrl =
                    'https://t3.ftcdn.net/jpg/02/48/55/64/360_F_248556444_mfV4MbFD2UnfSofsOJeA8G7pIU8Yzfqc.jpg';
                    $imageUrl = isset($images[0]) ? asset('goods_img/' . $images[0]->img_url) : $defaultImageUrl;
                    @endphp
                    <img class="w-full h-64 object-cover object-center" src="{{ $imageUrl }}" alt="Product Image"
                        data-product-image="{{ $imageUrl }}">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-purple-600 mb-2 border-b-2 border-purple-800 pb-2"
                            style="height: 3.5rem; line-height: 1.75rem; /* Set to two lines of text */">{{
                            $good->g_name }}
                        </h3>
                        <p class="text-sm text-gray-600 font-bold mb-1" style="height: 1.5rem; line-height: 1.5rem;">
                            Description:</p>
                        <p class="text-sm text-gray-600 mb-1"
                            style="height: 3rem; line-height: 1.5rem; overflow: hidden;">{{
                            $good->g_desc }}</p>
                        <div class="mt-2 flex justify-between items-center">
                            <p class="text-sm text-gray-500">Category: {{ $good->g_category }}</p>
                            <p class="text-sm text-gray-500">Age: {{ $good->g_age }} Years</p>
                        </div>
                        <hr class="my-4 border-b-2 border-gray-800"> <!-- Garis pembatas -->
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600 text-xs font-bold order-last">Current Price Est.: <br> Rp
                                {{
                                number_format($good->g_price_prediction, 0, ',', '.') }}</span>
                            <a href="{{ route('goods_detail', ['hashed_id' => Hashids::encode($good->g_ID)]) }}"
                                class="inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-sm">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            @endif
        </div>
    </div>
</div>

<div class="pt-0 pb-10 font-rubik">
    <div class="mt-10 mx-10">
        <div class="container mx-auto">
            <h2 class="text-3xl font-semibold text-purple-600 mb-3">Exchanged Goods</h2>
            <h2 class="text-xl font-semibold text-red-600 mb-6">Please remember to update the status of the goods.</h2>
            @if ($exchangedGoods->isEmpty())
            <p class="text-lg text-gray-600">You haven't exchanged any goods yet.</p>
            @else
            <div class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6">
                @foreach ($exchangedGoods as $exchange)
                <a href="{{ route('exchange.details', ['userGoodsId' => $exchange->userGoods->g_ID, 'otherUserGoodsId' => $exchange->otherUserGoods->g_ID]) }}"
                    class="block hover:opacity-75">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Display exchanged goods information -->
                        <div class="flex flex-col">
                            <!-- Your goods -->
                            <div class="p-6">
                                <img class="w-full h-64 object-cover object-center"
                                    src="{{ optional($exchange->userGoods->images->first())->img_url ? asset('goods_img/' . $exchange->userGoods->images->first()->img_url) : '' }}"
                                    alt="Your Product Image">
                                <h3 class="text-lg font-semibold text-purple-600 mb-2 border-b-2 border-purple-800 pb-2"
                                    style="height: 3.5rem; line-height: 1.75rem;">{{ $exchange->userGoods->g_name }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-1"
                                    style="height: 3rem; line-height: 1.5rem; overflow: hidden;">
                                    {{ $exchange->userGoods->g_desc }}</p>
                                <p class="text-sm text-gray-500 mt-2">Category: {{ $exchange->userGoods->g_category }}
                                </p>
                                <p class="text-sm font-semibold text-gray-700 mt-4">Current Price Est.: Rp {{
                                    number_format($exchange->userGoods->g_price_prediction, 0, ',', '.') }}</p>
                            </div>
                            <!-- Barter with goods -->
                            <div class="p-6 flex flex-col items-center">
                                <div class="flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    <p class="text-lg font-semibold text-white bg-green-500 rounded-lg p-2">Barter with
                                    </p>
                                </div>
                                <img class="w-full h-64 object-cover object-center mb-4"
                                    src="{{ optional($exchange->otherUserGoods->images->first())->img_url ? asset('goods_img/' . $exchange->otherUserGoods->images->first()->img_url) : '' }}"
                                    alt="Bartered Product Image">
                                <h3 class="text-lg font-semibold text-purple-600 mb-2 border-b-2 border-purple-800 pb-2"
                                    style="height: 3.5rem; line-height: 1.75rem;">{{ $exchange->otherUserGoods->g_name
                                    }}</h3>
                                <p class="text-sm text-gray-600 mb-1"
                                    style="height: 3rem; line-height: 1.5rem; overflow: hidden;">
                                    {{ $exchange->otherUserGoods->g_desc }}</p>
                                <p class="text-sm text-gray-500 mt-2">Category: {{ $exchange->otherUserGoods->g_category
                                    }}</p>
                                <p class="text-sm font-semibold text-gray-700 mt-4">Current Price Est.: Rp {{
                                    number_format($exchange->otherUserGoods->g_price_prediction, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
            @include('utils.layouts.footer.footer')
        </div>
    </div>
</div>







@include('utils.user.modalEditProfile')
@include('utils.user.modalChangeAddress')
@include('utils.user.modalUpdateAvatar')
@include('utils.user.modalFollowers')
@include('utils.user.modalFollowing')





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
    document.addEventListener('DOMContentLoaded', function() {
// JavaScript untuk menampilkan dan menyembunyikan modal
        const followersModal = document.getElementById('followersModal');
        const followingModal = document.getElementById('followingModal');
        const closeFollowersModal = document.getElementById('closeFollowersModal');
        const closeFollowingModal = document.getElementById('closeFollowingModal');
        const viewFollowersLink = document.getElementById('viewFollowersLink');
        const viewFollowingLink = document.getElementById('viewFollowingLink');

        // Tampilkan modal pengikut saat link di klik
        viewFollowersLink.onclick = function() {
            followersModal.classList.remove('hidden');
        }

        // Tampilkan modal pengguna yang diikuti saat link di klik
        viewFollowingLink.onclick = function() {
            followingModal.classList.remove('hidden');
        }

        // Sembunyikan modal saat tombol close diklik
        closeFollowersModal.onclick = function() {
            followersModal.classList.add('hidden');
        }

        closeFollowingModal.onclick = function() {
            followingModal.classList.add('hidden');
        }
    });


    // Get the wishlist count element
    const wishlistCount = document.getElementById('wishlist-count');
    const wishlistCount = document.getElementById('wishlist-count');

    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    wishlistCount.textContent = wishlist.length;

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