@include('utils.layouts.navbar.topnav')

<!-- component -->
<div class="pt-48">

    <div class="container mx-auto">
        <div class="py-6 h-screen">
            <div class="flex border border-grey rounded shadow-lg h-full">

                <!-- Left -->
                <div class="w-1/3 border flex flex-col">
                    <!-- Header -->
                    @include('utils.chat.header')

                    <!-- Search -->
                    @include('utils.chat.search')

                    <!-- Contacts -->
                    @include('utils.chat.contacts')

                </div>


                <!-- Right -->
                @if(request()->filled('logged_in_user') && request()->filled('owner_user'))
                <div class="w-2/3 border flex flex-col">
                    <!-- Header -->
                    @include('utils.chat.chatHeader')

                    <!-- Messages -->
                    @include('utils.chat.messages')

                    <!-- Input -->
                    @include('utils.chat.inputChat')
                </div>
                @else
                <div class="w-2/3 border flex flex-col bg-[#F2F2F2] justify-center items-center">
                    <div class="text-center">
                        <div class="text-[10rem] mb-10 text-primary text-opacity-35"><i class="fa fa-comments-o"
                                aria-hidden="true"></i>
                        </div>
                        <p class="text-[2.5rem] font-bold text-primary">Welcome to the Barter Messaging System</p>
                        <p class="mt-4">Start a conversation by selecting a contact on the left</p>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

{{-- Modal exchange goods (barter) -> if barter is accepted --}}
@include('utils.chat.modalExchangeBarter')

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="/js/moment.js"></script>
<script>
    import {
            Modal
        } from 'flowbite';
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function sendMessage(isReply = false) {
        const loggedInUserId = '{{ $loggedInUserId }}';
        const ownerUserId = '{{ $ownerUserId }}';
        const message = document.getElementById('messageInput').value.trim();

        if (message === '') {
            document.getElementById('sendMessageBtn').disabled = true;
            return;
        }

        if (message !== '') {
            axios.post('api/chat/send', {
                sender_id: loggedInUserId,
                receiver_id: ownerUserId,
                message: message,
                is_reply: isReply,
            })
            .then(function (response) {
                const formattedMessage = `
                <div class="flex justify-end mb-2">
                    <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
                        <p class="text-sm mt-1">
                            ${message}
                        </p>
                        <p class="text-right text-xs text-grey-dark mt-1">
                            You • ${moment().format('HH:mm')}
                        </p>
                    </div>
                </div>
                `;

                const chatMessagesContainer = document.getElementById('mainChat');
                chatMessagesContainer.appendChild(document.createRange().createContextualFragment(formattedMessage));
                chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;

                $('#messageInput').val('');
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
        } else {
            Swal.fire({
                icon: 'error',
                text: 'Please enter a message',
                timer: 1500,
                showConfirmButton: false
            });
        }
    }

        
     document.getElementById('messageInput').addEventListener('keydown', function(event) {
        if (event.shiftKey && event.key === 'Enter') {
            this.value += '\n';
            event.preventDefault();
        } else if (event.key === 'Enter' && !event.shiftKey) {
            sendMessage();
            event.preventDefault();
        }
    });

    document.getElementById('sendMessageBtn').addEventListener('click', function(event) {
        sendMessage();
        event.preventDefault();
    });
</script>