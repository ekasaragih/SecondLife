<div class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center">
    <div class="flex items-center">
        <div>
            <img class="w-10 h-10 rounded-full"
                src="https://i.pinimg.com/564x/a0/55/ee/a055eeaa4c31c142ff8d94a42e6939f2.jpg" />
        </div>
        <div class="ml-4">
            <p class="text-grey-darkest">
                {{ $ownerName }}
            </p>
            <p class="text-grey-darker text-xs mt-1">
                {{ $product->us_username }}
            </p>
        </div>
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