<footer class="mt-12 left-0 w-full bg-white shadow flex items-center justify-between p-6 ">
    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© <script>
            document.write(new Date().getFullYear())
        </script>
        <a href="/" class="hover:underline">SecondLife™</a>. All Rights Reserved.
    </span>
    <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
        <li>
            <a href="{{ route('about_us') }}" class="hover:underline me-4 md:me-6">About</a>
        </li>
        <li>
            <a href="{{ route('privacy_policy') }}" class="hover:underline me-4 md:me-6">Privacy Policy</a>
        </li>
        <li>
            <a href="{{ route('contact_us') }}" class="hover:underline">Contact</a>
        </li>
    </ul>
</footer>