<!-- userProfile.blade.php -->
@extends('utils.layouts.navbar.topnav')

<div class="flex items-center justify-center pt-52">
    <div class="container w-4/5">
        <div class="container mx-auto max-w-screen-lg flex items-center justify-between mb-4">
            <!-- Foto profil -->
            <img class="h-32 w-32 rounded-full border-4 border-white mr-4" id="user_avatar"
                src="{{ $user->avatar ? asset('users_img/' . $user->avatar) : 'https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg' }}"
                alt="User Avatar"> <!-- Menggunakan atribut avatar dari model pengguna -->

            <!-- Informasi profil -->
            <div>
                <!-- Nama -->
                <h1 class="text-3xl font-semibold font-rubik text-purple-600">{{ $user->us_name }}'s Profile</h1>

                <!-- Lokasi -->
                <p class="text-sm text-gray-600 font-rubik">Location: {{ $user->us_city ?? 'Not specified' }}</p>
                <!-- Follow button -->
                @if($user->us_ID !== auth()->id())
                @if(auth()->user()->isFollowing($user))
                <div>
                    <form id="unfollowForm" action="{{ route('user.unfollow', $user) }}" method="POST"
                        class="inline-block">
                        @csrf
                        <button id="followButton" type="submit"
                            class="mt-4 bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                            Followed
                        </button>
                    </form>
                    <a href="{{ route('home_chat', ['logged_in_user' => Auth::id(), 'owner_user' => $user->us_ID]) }}"
                        title="Messages"
                        class="mt-4 ml-2 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Chat
                    </a>
                </div>
                @else
                <div>
                    <form id="followForm" action="{{ route('user.follow', $user) }}" method="POST" class="inline-block">
                        @csrf
                        <button id="followButton" type="submit"
                            class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Follow
                        </button>
                    </form>
                    <a href="{{ route('home_chat', ['logged_in_user' => Auth::id(), 'owner_user' => $user->us_ID]) }}"
                        title="Messages"
                        class="mt-4 ml-2 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Chat
                    </a>
                </div>
                @endif
                @else
                <a href="{{ route('my_profile') }}" title="My Profile" class="text-xl mt-5 underline text-blue-700">
                    <i>Edit profile</i>
                    <span><i class="fa fa-pencil" aria-hidden="true"></i></span>
                </a>
                @endif
            </div>

            <!-- Follower and Following Counts (moved to the right) -->
            <div class="ml-auto text-right">
                <p class="text-lg font-semibold text-gray-800 font-rubik">
                    <!-- Menggunakan class `font-rubik` -->
                    <span class="font-semibold"><a href="#followersModal" id="viewFollowersLink"
                            class="text-gray-800 underline">Followers:</a></span>
                    <span class="ml-2 text-purple-600" id="followerCount">{{ $user->followers()->count() }}</span>
                </p>
                <p class="text-lg font-semibold text-gray-800 font-rubik">
                    <!-- Menggunakan class `font-rubik` -->
                    <span class="font-semibold"><a href="#followingModal" id="viewFollowingLink"
                            class="text-gray-800 underline">Following:</a></span>
                    <span class="ml-2 text-purple-600">{{ $user->following()->count() }}</span>
                </p>
            </div>
        </div>

        <hr class="my-4 border-b-2 border-gray-300 shadow-md">

        @if ($goods->isEmpty())
        <p class="text-xl text-gray-600">No goods found for this user.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($goods as $good)
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
                        style="height: 3.5rem; line-height: 1.75rem; /* Set to two lines of text */">{{ $good->g_name }}
                    </h3>
                    <p class="text-sm text-gray-600 font-bold mb-1" style="height: 1.5rem; line-height: 1.5rem;">
                        Description:</p>
                    <p class="text-sm text-gray-600 mb-1" style="height: 3rem; line-height: 1.5rem; overflow: hidden;">
                        {{ $good->g_desc }}</p>
                    <div class="mt-2 flex justify-between items-center">
                        <p class="text-sm text-gray-500">Category: {{ $good->g_category }}</p>
                        <p class="text-sm text-gray-500">Age: {{ $good->g_age }} Years</p>
                    </div>
                    <hr class="my-4 border-b-2 border-gray-800"> <!-- Garis pembatas -->
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-gray-600 text-xs font-bold order-last">Current Price Est.: <br> Rp {{
                            number_format($good->g_price_prediction, 0, ',', '.') }}</span>
                        <a href="{{ route('goods_detail', ['hashed_id' => Hashids::encode($good->g_ID)]) }}"
                            class="inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-sm">
                            Detail
                        </a>


                    </div>
                    @if ($good->isExchanged())
                    <p class="text-red-500 italic mt-2">This goods has been bartered.</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<!-- Followers Modal -->
<div id="followersModal"
    class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3 relative">
        <span id="closeFollowersModal"
            class="absolute top-4 right-4 p-2 cursor-pointer text-purple-700 font-semibold font-rubik text-2xl">&times;</span>
        <h2 class="text-2xl font-semibold mb-4 text-center text-purple-600 font-rubik">Followers</h2>
        <hr class="my-2 border-purple-700"> <!-- Garis pembatas dengan sedikit spasi -->
        <ul id="followersList" class="text-left">
            @foreach ($user->followers as $follower)
            <li class="flex items-center mb-2">
                <img src="{{ $follower->avatar }}" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2">
                <a href="{{ route('userProfile', ['username' => $follower->us_name]) }}"
                    class="text-purple-700 font-rubik">{{ $follower->us_name }}</a>
            </li>

            @endforeach
        </ul>
    </div>
</div>

<!-- Following Modal -->
<div id="followingModal"
    class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3 relative">
        <span id="closeFollowingModal"
            class="absolute top-4 right-4 p-2 cursor-pointer text-purple-700 font-semibold font-rubik text-2xl">&times;</span>
        <h2 class="text-2xl font-semibold mb-4 text-center text-purple-600 font-rubik">Following</h2>
        <hr class="my-2 border-purple-700"> <!-- Garis pembatas dengan sedikit spasi -->
        <ul id="followingList" class="text-left">
            @foreach ($user->following as $followed)
            <li class="flex items-center mb-2">
                <img src="{{ $followed->avatar }}" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2">
                <a href="{{ route('userProfile', ['username' => $followed->us_name]) }}"
                    class="text-purple-700 font-rubik">{{ $followed->us_name }}</a>
            </li>

            @endforeach
        </ul>
    </div>
</div>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        const followForm = document.getElementById('followForm');
        const followButton = document.getElementById('followButton');
        const followerCountSpan = document.getElementById('followerCount');

        // Check if the current user is following the profile user
        let isFollowing = {{ auth()->user()->isFollowing($user) ? 'true' : 'false' }};
        
        // Function to update button appearance based on follow status
        const updateButtonState = (following) => {
            if (following) {
                followButton.textContent = 'Followed';
                followButton.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                followButton.classList.add('bg-purple-500', 'hover:bg-purple-700');
            } else {
                followButton.textContent = 'Follow';
                followButton.classList.remove('bg-purple-500', 'hover:bg-purple-700');
                followButton.classList.add('bg-blue-500', 'hover:bg-blue-700');
            }
        };

        // Initialize button state
        updateButtonState(isFollowing);

        if (followForm) {
            followForm.addEventListener('submit', function(event) {
                event.preventDefault();

                fetch(followForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Toggle button text and appearance
                        isFollowing = !isFollowing;
                        updateButtonState(isFollowing);

                        // Update follower count if following action is successful
                        if (isFollowing) {
                            followerCountSpan.textContent = parseInt(followerCountSpan.textContent) + 1;
                        } else {
                            followerCountSpan.textContent = parseInt(followerCountSpan.textContent) - 1;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }

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
</script>

@include('utils.layouts.footer.footer')