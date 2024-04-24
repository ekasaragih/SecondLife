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
                <div class="w-2/3 border flex flex-col">

                    <!-- Header -->
                    @include('utils.chat.chatHeader')

                    <!-- Messages -->
                    @include('utils.chat.messages')

                    <!-- Input -->
                    @include('utils.chat.inputChat')
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function sendMessage() {
        const loggedInUserId = '{{ $loggedInUserId }}';
        const ownerUserId = '{{ $ownerUserId }}';
        const message = document.getElementById('messageInput').value.trim();

        const productName = $('#productName').text();
        const productDesc = $('#productDesc').text();
        const productCategory = $('#productCategory').text();
        const productType = $('#productType').text();
        const productPrice = $('#productPrice').text();

            if (message !== '') {
              
                axios.post('api/chat/send', {
                    sender_id: loggedInUserId,
                    receiver_id: ownerUserId,
                    message: message
                })
                .then(function (response) {
                
                    const formattedMessage = `
                    <div class="flex justify-end mb-2">
                        <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
                            <p class="text-sm mt-1">
                                ${message}
                            </p>
                            <p class="text-right text-xs text-grey-dark mt-1">
                                You • ${moment().format('LT')}
                            </p>
                        </div>
                    </div>
                    `;
                    document.getElementById('chatMessages').insertAdjacentHTML('beforeend', formattedMessage);
                    document.getElementById('messageInput').value = '';
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
        
        document.getElementById('messageInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        });

        document.getElementById('sendMessageBtn').addEventListener('click', sendMessage);
</script>