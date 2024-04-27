@include('utils.layouts.navbar.topnav')

<div class="flex items-center justify-center pt-52">
    <div class="container w-4/5">
        <div class="container mx-auto max-w-screen-lg">
            <div class="flex items-center mb-4">
                <!-- Foto profil -->
                <img class="h-32 w-32 rounded-full border-4 border-white mr-4" id="user_avatar"
                    src="https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg" alt="User Avatar">

                <!-- Informasi profil -->
                <div>
                    <!-- Nama -->
                    <h1 class="text-3xl font-semibold">usID check: {{ $user->us_ID }}</h1>
                    <h1 class="text-3xl font-semibold">{{ $user->us_name }}'s Profile</h1>
                    
                    <!-- Lokasi -->
                    <p class="text-sm text-gray-600">Location: {{ $user->us_city ?? 'Not specified' }}</p>
                    
                    <!-- Follow button -->
                    @if(auth()->user()->isFollowing($user))
                        <form id="unfollowForm" action="{{ route('user.unfollow', $user) }}" method="POST">
                            @csrf
                            <button id="followButton" type="submit" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Following
                            </button>
                        </form>
                    @else
                    <form id="followForm" action="{{ route('user.follow', $user) }}" method="POST">
    @csrf
    <button id="followButton" type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Follow
    </button>
</form>
                    @endif

                    <!-- Menampilkan jumlah Follower -->
<p class="text-sm text-gray-600">Followers: {{ $user->followers()->count() }}</p>

<!-- Menampilkan jumlah Following -->
<p class="text-sm text-gray-600">Following: {{ $user->following()->count() }}</p>

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
                                    <p class="text-sm font-semibold text-gray-700">Price: Rp {{ number_format($good->g_original_price, 0, ',', '.') }}</p>
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
</div>

@include('utils.layouts.navbar.topnav')

<div class="flex items-center justify-center pt-52">
    <div class="container w-4/5">
        <div class="container mx-auto max-w-screen-lg">
            <div class="flex items-center mb-4">
                <!-- Foto profil -->
                <img class="h-32 w-32 rounded-full border-4 border-white mr-4" id="user_avatar"
                    src="https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg" alt="User Avatar">

                <!-- Informasi profil -->
                <div>
                    <!-- Nama -->
                    <h1 class="text-3xl font-semibold">usID check: {{ $user->us_ID }}</h1>
                    <h1 class="text-3xl font-semibold">{{ $user->us_name }}'s Profile</h1>
                    
                    <!-- Lokasi -->
                    <p class="text-sm text-gray-600">Location: {{ $user->us_city ?? 'Not specified' }}</p>
                    
                    <!-- Follow button -->
                    @if(auth()->user()->isFollowing($user))
                        <form id="unfollowForm" action="{{ route('user.unfollow', $user) }}" method="POST">
                            @csrf
                            <button id="followButton" type="submit" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Following
                            </button>
                        </form>
                    @else
                    <form id="followForm" action="{{ route('user.follow', $user) }}" method="POST">
    @csrf
    <button id="followButton" type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Follow
    </button>
</form>
                    @endif

                    <div class="ml-auto text-right">
        <p class="text-sm text-gray-600">Followers: {{ $user->followers()->count() }}</p>
        <p class="text-sm text-gray-600">Following: {{ $user->following()->count() }}</p>
    </div>

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
                                    <p class="text-sm font-semibold text-gray-700">Price: Rp {{ number_format($good->g_original_price, 0, ',', '.') }}</p>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const followForm = document.getElementById('followForm');
        const followButton = document.getElementById('followButton');

        // Check if the current user is following the profile user
        const isFollowing = {{ auth()->user()->isFollowing($user) ? 'true' : 'false' }};
        
        // Function to update button appearance based on follow status
        const updateButtonState = (following) => {
            if (following) {
                followButton.textContent = 'Following';
                followButton.classList.remove('bg-blue-500', 'hover:bg-blue-700');
                followButton.classList.add('bg-green-500', 'hover:bg-green-700');
            } else {
                followButton.textContent = 'Follow';
                followButton.classList.remove('bg-green-500', 'hover:bg-green-700');
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
                        updateButtonState(!isFollowing);
                        // Update follow status
                        isFollowing = !isFollowing;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        }
    });
</script>



@include('utils.layouts.footer.footer')
