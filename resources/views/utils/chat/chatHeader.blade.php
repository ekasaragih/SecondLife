<div class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center">
    <div class="flex items-center">
        <a href="{{ route('userProfile', ['username' => $ownerUsername]) }}" class="flex items-center">
            <div>
                @if ($ownerAvatar)
                <img class="w-10 h-10 rounded-full" src="{{ asset('users_img/' . $ownerAvatar) }}" alt="User Avatar" />
                @else
                <img class="w-10 h-10 rounded-full"
                    src="https://t3.ftcdn.net/jpg/02/48/55/64/360_F_248556444_mfV4MbFD2UnfSofsOJeA8G7pIU8Yzfqc.jpg"
                    alt="Default Avatar" />
                @endif
            </div>
            <div class="ml-4">
                <p class="text-grey-darkest">
                    {{ $ownerName }}
                </p>
                <p class="text-grey-darker text-xs mt-1">
                    <span>@</span>{{ $ownerUsername }}
                </p>
            </div>
        </a>
    </div>

    <div class="flex">
        <div class="ml-6">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path fill="#263238" fill-opacity=".6"
                    d="M12 7a2 2 0 1 0-.001-4.001A2 2 0 0 0 12 7zm0 2a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 9zm0 6a2 2 0 1 0-.001 3.999A2 2 0 0 0 12 15z">
                </path>
            </svg>
        </div>
    </div>
</div>