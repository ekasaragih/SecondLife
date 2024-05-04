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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan elemen modal dan tombol untuk menutup modal
        const followersModal = document.getElementById('followersModal');
        const closeFollowersModal = document.getElementById('closeFollowersModal');
        
        // Menampilkan modal saat tombol "Followers" diklik
        document.getElementById('viewFollowersLink').addEventListener('click', function() {
            followersModal.classList.remove('hidden');
        });
        
        // Menyembunyikan modal saat tombol close di klik
        closeFollowersModal.addEventListener('click', function() {
            followersModal.classList.add('hidden');
        });
    });
</script>
