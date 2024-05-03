<!-- Left Section Header -->
<div class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center">

    <div>
        {{-- Check if user is logged in --}}
        @auth
        {{-- Get the logged-in user's avatar image --}}
        @if (Auth::user()->avatar)
        {{-- Use the user's avatar --}}
        <img class="w-10 h-10 rounded-full" src="{{ asset('users_img/' . Auth::user()->avatar) }}" alt="User Avatar" />
        @else
        {{-- Fallback image if the user doesn't have an avatar --}}
        <img class="w-10 h-10 rounded-full"
            src="https://t3.ftcdn.net/jpg/02/48/55/64/360_F_248556444_mfV4MbFD2UnfSofsOJeA8G7pIU8Yzfqc.jpg"
            alt="Default Avatar" />
        @endif
        @endauth
    </div>

    <div class="flex">

    </div>
</div>