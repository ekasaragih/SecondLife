<div class="bg-grey-lighter flex-1 overflow-auto">
    {{-- Container untuk list of contacts --}}
    @foreach ($contacts as $contact)
    <div class="bg-white px-3 flex items-center hover:bg-grey-lighter cursor-pointer">
        {{-- Container untuk img --}}
        <div>
            <img class="h-12 w-12 rounded-full" src="{{ $contact->avatar }}" alt="{{ $contact->us_name }}" />
        </div>
        <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
            <div class="flex items-bottom justify-between">
                <p class="text-grey-darkest">
                    {{ $contact->us_name }}
                </p>
                <p class="text-xs text-grey-darkest">
                    {{-- Waktu dari last message dari other user yang ngechat si logged in user --}}
                    {{ $contact->last_message_time }}
                </p>
            </div>
            <p class="text-grey-dark mt-1 text-sm">
                {{-- Last message dari other user yang ngechat si logged in user --}}
                {{ $contact->last_message }}
            </p>
        </div>
    </div>
    @endforeach
</div>