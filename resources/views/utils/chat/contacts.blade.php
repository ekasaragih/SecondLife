<div class="bg-grey-lighter flex-1 overflow-auto">
    @foreach ($contacts as $contact)
    <a href="{{ route('home_chat', ['logged_in_user' => $loggedInUserId, 'owner_user' => $contact->us_ID]) }}"
        class="block hover:bg-grey-lighter">
        <div class="bg-white px-3 flex items-center cursor-pointer">
            <div>
                <img class="h-12 w-12 rounded-full" src="{{ asset('users_img/' . $contact->avatar) }}"
                    alt="{{ $contact->us_name }}" />
            </div>
            <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
                <div class="flex items-bottom justify-between">
                    <p class="text-grey-darkest">
                        {{ $contact->us_name }}
                    </p>
                    <p class="text-xs text-grey-darkest">
                        {{ $contact->last_message_time }}
                    </p>
                </div>
                <p class="text-grey-dark mt-1 text-sm">
                    {{ $contact->last_message }}
                </p>
            </div>
        </div>
    </a>
    @endforeach
</div>