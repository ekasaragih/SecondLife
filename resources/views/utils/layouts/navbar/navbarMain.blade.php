<nav class="hidden xl:block lg:block mb-5">
    <ul class="flex justify-center gap-24">
        <li class="relative text-xl">
            <a href="{{ url('/') }}"
                class="font-semibold uppercase transition duration-300 hover:text-primary hover:opacity-75 {{ request()->is('/') ? 'text-primary underline transition duration-300' : 'focus:text-secondary' }}">Explore</a>
            <ul id="explore-dropdown" class="hidden absolute bg-white mt-2 w-96 border border-gray-200 rounded-lg shadow-lg z-10">
                <li><a href="{{ route('explore') }}#swape" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Explore</a></li>
                <li><a href="{{ route('explore') }}#recommendationLocation" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Based on Your Location</a></li>
                <li><a href="{{ route('explore') }}#trendingPrediction" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Trending Now</a></li>
            </ul>
        </li>

        <li class="relative text-xl" id="categories-menu">
            <a href="{{ route('categories') }}"
                class="font-semibold uppercase transition duration-300 hover:text-primary hover:opacity-75 relative {{ request()->routeIs('categories') ? 'text-primary underline transition duration-300' : 'focus:text-secondary' }}">Categories</a>
            <ul id="categories-dropdown" class="hidden absolute bg-white mt-2 w-64 border border-gray-200 rounded-lg shadow-lg z-10">
                <li><a href="{{ route('categories') }}#category" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Category</a></li>
                <li><a href="{{ route('categories') }}#recommendation" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Based on Your Preference</a></li>
            </ul>
        </li>

        <li class="relative text-xl" id="communities-menu">
            <a href="{{ route('communities') }}"
                class="font-semibold uppercase transition duration-300 hover:text-primary hover:opacity-75 relative {{ request()->routeIs('communities') ? 'text-primary underline transition duration-300' : 'focus:text-secondary' }}">Communities</a>
            <ul id="communities-dropdown" class="hidden absolute bg-white mt-2 w-64 border border-gray-200 rounded-lg shadow-lg z-10">
                <li><a href="{{ route('communities') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Communities</a></li>
            </ul>
        </li>
    </ul>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const exploreLink = document.querySelector('a[href="{{ url("/") }}"]');
    const exploreDropdown = document.getElementById('explore-dropdown');
    const categoriesMenu = document.getElementById('categories-menu');
    const categoriesLink = categoriesMenu.querySelector('a[href="{{ route("categories") }}"]');
    const categoriesDropdown = document.getElementById('categories-dropdown');
    const communitiesMenu = document.getElementById('communities-menu');
    const communitiesLink = communitiesMenu.querySelector('a[href="{{ route("communities") }}"]');
    const communitiesDropdown = document.getElementById('communities-dropdown');

    let currentDropdown = null;

    // Menampilkan dropdown Explore saat di-hover
    exploreLink.addEventListener('mouseenter', function () {
        hideDropdown();
        exploreDropdown.classList.remove('hidden');
        currentDropdown = exploreDropdown;
    });

    // Menampilkan dropdown Categories saat di-hover
    categoriesMenu.addEventListener('mouseenter', function () {
        hideDropdown();
        categoriesDropdown.classList.remove('hidden');
        currentDropdown = categoriesDropdown;
    });

    // Menampilkan dropdown Communities saat di-hover
    communitiesMenu.addEventListener('mouseenter', function () {
        hideDropdown();
        communitiesDropdown.classList.remove('hidden');
        currentDropdown = communitiesDropdown;
    });

    // Menyembunyikan dropdown saat mouse meninggalkan item atau dropdown
    function hideDropdown() {
        if (currentDropdown !== null) {
            currentDropdown.classList.add('hidden');
            currentDropdown = null;
        }
    }

    // Menyembunyikan dropdown saat mouse meninggalkan menu utama
    document.querySelector('.flex').addEventListener('mouseleave', function () {
        hideDropdown();
    });
});
</script>
