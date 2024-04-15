<footer class="bg-primary-content bg-opacity-25 rounded-lg shadow-xl m-4 mt-[600px]">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="/asset/img/main-logo.png" class="h-16" alt="SecondLife Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">SecondLife</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="{{ route('privacy_policy') }}" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                {{-- <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li> --}}
                <li>
                    <a href="{{ route('contact_us') }}" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-300 sm:mx-auto lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center">©
            <script>
                document.write(new Date().getFullYear())
            </script>
            <a href="/" class="hover:underline">SecondLife™</a>. All Rights Reserved.
        </span>
    </div>
</footer>