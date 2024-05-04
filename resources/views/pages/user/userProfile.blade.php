<!-- userProfile.blade.php -->
@extends('utils.layouts.navbar.topnav')

<div class="flex items-center justify-center pt-52">
    <div class="container w-4/5">
        <div class="container mx-auto max-w-screen-lg flex items-center justify-between mb-4">
            <!-- Foto profil -->
            <img class="h-32 w-32 rounded-full border-4 border-white mr-4" id="user_avatar"
                src="{{ $user->avatar ?? 'https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg' }}" alt="User Avatar"> <!-- Menggunakan atribut avatar dari model pengguna -->

            <!-- Informasi profil -->
            <div>
                <!-- Nama -->
                <h1 class="text-3xl font-semibold font-rubik text-purple-600">{{ $user->us_name }}'s Profile</h1>

    <!-- Lokasi -->
    <p class="text-sm text-gray-600 font-rubik">Location: {{ $user->us_city ?? 'Not specified' }}</p>
                <!-- Follow button -->
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
            </div>

            <!-- Follower and Following Counts (moved to the right) -->
            <div class="ml-auto text-right">
                <p class="text-lg font-semibold text-gray-800 font-rubik">
                    <!-- Menggunakan class `font-rubik` -->
                    <span class="font-semibold"><a href="#followersModal" id="viewFollowersLink" class="text-gray-800 underline">Followers:</a></span>
                    <span class="ml-2 text-purple-600" id="followerCount">{{ $user->followers()->count() }}</span>
                </p>
                <p class="text-lg font-semibold text-gray-800 font-rubik">
                    <!-- Menggunakan class `font-rubik` -->
                    <span class="font-semibold"><a href="#followingModal" id="viewFollowingLink" class="text-gray-800 underline">Following:</a></span>
                    <span class="ml-2 text-purple-600">{{ $user->following()->count() }}</span>
                </p>
            </div>
        </div>

        @if ($goods->isEmpty())
        <p class="text-xl text-gray-600">No goods found for this user.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($goods as $good)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ $good->images->first()->img_url ?? 'https://via.placeholder.com/400' }}"
                    alt="Product Image">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">{{ $good->g_name }}</h3>
                    <p class="text-sm text-gray-600">{{ $good->g_desc }}</p>
                    <div class="mt-2 flex justify-between items-center">
                        <p class="text-sm text-gray-500">Category: {{ $good->g_category }}</p>
                        <p class="text-sm text-gray-500">Age: {{ $good->g_age }} Years</p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-sm font-semibold text-gray-700">Price: Rp {{
                            number_format($good->g_original_price, 0, ',', '.') }}</p>
                        <a href="{{ route('goods_detail', ['id' => $good->g_ID]) }}"
                            class="text-sm font-medium text-purple-600 hover:text-purple-800">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<!-- Followers Modal -->
<div id="followersModal" class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3 relative">
        <span id="closeFollowersModal" class="absolute top-4 right-4 p-2 cursor-pointer text-purple-700 font-semibold font-rubik text-2xl">&times;</span>
        <h2 class="text-2xl font-semibold mb-4 text-center text-purple-600 font-rubik">Followers</h2>
        <hr class="my-2 border-purple-700"> <!-- Garis pembatas dengan sedikit spasi -->
        <ul id="followersList" class="text-left" >
            @foreach ($user->followers as $follower)
            <li class="flex items-center mb-2">
    <img src="{{ $follower->avatar }}" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2">
    <a href="{{ route('userProfile', ['username' => $follower->us_name]) }}" class="text-purple-700 font-rubik">{{ $follower->us_name }}</a>
</li>

            @endforeach
        </ul>
    </div>
</div>

<!-- Following Modal -->
<div id="followingModal" class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3 relative">
        <span id="closeFollowingModal" class="absolute top-4 right-4 p-2 cursor-pointer text-purple-700 font-semibold font-rubik text-2xl">&times;</span>
        <h2 class="text-2xl font-semibold mb-4 text-center text-purple-600 font-rubik">Following</h2>
        <hr class="my-2 border-purple-700"> <!-- Garis pembatas dengan sedikit spasi -->
        <ul id="followingList" class="text-left">
            @foreach ($user->following as $followed)
            <li class="flex items-center mb-2">
    <img src="{{ $followed->avatar }}" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2">
    <a href="{{ route('userProfile', ['username' => $followed->us_name]) }}" class="text-purple-700 font-rubik">{{ $followed->us_name }}</a>
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
