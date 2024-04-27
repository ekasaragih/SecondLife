<div class="flex-1 overflow-auto" style="background-color: #DAD3CC">
    <div class="py-2 px-3">

        <div class="flex justify-center mb-4">
            <div class="rounded py-2 px-4" style="background-color: #FCF4CB">
                <p class="text-xs">
                    Please be careful in sharing personal information to ensure your safety.
                </p>
            </div>
        </div>

        {{-- Display chat messages --}}
        @php
        $prevDate = null;
        @endphp
        @foreach($chatMessages as $message)

        @if($message->created_at->format('d/m/Y') !== $prevDate)
        <div class="flex justify-center mb-2">
            <div class="rounded py-2 px-4" style="background-color: #DDECF2">
                <p class="text-sm uppercase">
                    {{ $message->created_at->format('d/m/Y') }}
                </p>
            </div>
        </div>
        @endif

        {{-- Update previous date --}}
        @php
        $prevDate = $message->created_at->format('d/m/Y');
        @endphp

        {{-- Display chat messages --}}
        @if($message->sender_id == $loggedInUserId)
        {{-- Right section chat from logged-in user --}}
        <div class="flex justify-end mb-2">
            <div class="rounded py-2 px-3 max-w-96 break-words overflow-hidden" style="background-color: #E2F7CB">
                <p class="text-sm mt-1 whitespace-normal max-w-full text-left">
                    {{ $message->message }}
                </p>
                <p class="text-right text-xs text-grey-dark mt-1">
                    You • {{ $message->created_at->format('H:i') }}
                </p>
            </div>
        </div>
        @else
        {{-- Left section chat from other user --}}
        <div class="flex mb-2">
            <div class="rounded py-2 px-3 max-w-96 overflow-hidden" style="background-color: #F2F2F2">
                <p class="text-sm mt-1 whitespace-normal max-w-full">
                    {{ $message->message }}
                </p>
                <p class="text-right text-xs text-grey-dark mt-1">
                    {{ $ownerName }} • {{ $message->created_at->format('H:i') }}
                </p>
            </div>
        </div>
        @endif
        @endforeach

        {{-- Chat from logged in user --}}
        <div id="chatMessages"></div>

        <div class="flex justify-center mb-4">
            <div class="rounded py-2 px-4 bg-white">
                <p class="text-xs">
                    @if($recentExchange)
                    You have bartered {{ $recentExchange->userGoods->g_name }} with {{
                    $recentExchange->otherUser->us_name }}'s
                    {{ $recentExchange->otherUserGoods->g_name }}
                    @else
                    No recent barter found
                    @endif
                </p>
            </div>
        </div>

        {{-- ini keknya cuma buat user yg logged in aja --}}
        <div class="flex justify-center mt-5">
            <div
                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center pb-10">
                    <span class="text-sm text-gray-500 dark:text-gray-400 mt-5">Please confirm this after you have done
                        the discussion.</span>
                    <div class="flex mt-4 md:mt-6">
                        <a data-modal-target="modalExchangeBarter" data-modal-toggle="modalExchangeBarter"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Accept barter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>