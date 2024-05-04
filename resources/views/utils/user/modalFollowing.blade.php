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
        // Mendapatkan elemen modal dan tombol untuk menutup modal
        const followingModal = document.getElementById('followingModal');
        const closeFollowingModal = document.getElementById('closeFollowingModal');
        
        // Menampilkan modal saat tombol "Following" diklik
        document.getElementById('viewFollowingLink').addEventListener('click', function() {
            followingModal.classList.remove('hidden');
        });
        
        // Menyembunyikan modal saat tombol close di klik
        closeFollowingModal.addEventListener('click', function() {
            followingModal.classList.add('hidden');
        });
    });
</script>
