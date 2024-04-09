<nav class="hidden xl:block lg:block mb-5">
    <ul class="flex justify-center gap-24">
        <li class="relative text-xl">
            <a href="{{ url('/') }}"
                class="font-semibold uppercase transition duration-300 hover:text-primary-content {{ request()->is('/') ? 'text-primary underline transition duration-300' : 'focus:text-secondary' }}">Explore</a>
        </li>

        <li class="relative text-xl">
            <a href="{{ route('categories') }}"
                class="font-semibold uppercase transition duration-300 hover:text-primary-content {{ request()->routeIs('categories') ? 'text-primary underline transition duration-300' : 'focus:text-secondary' }}">Categories</a>
        </li>

        <li class="relative text-xl">
            <a href="{{ route('communities') }}"
                class="font-semibold uppercase transition duration-300 hover:text-primary-content {{ request()->routeIs('communities') ? 'text-primary underline transition duration-300' : 'focus:text-secondary' }}">Communities</a>
        </li>
    </ul>
</nav>