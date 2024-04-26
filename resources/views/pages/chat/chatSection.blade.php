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

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
        const results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    function sendMessage() {
        const loggedInUserId = '{{ $loggedInUserId }}';
        const ownerUserId = '{{ $ownerUserId }}';
        const message = document.getElementById('messageInput').value.trim();

        const goodsId = getParameterByName('goods');

        if (message === '') {
            document.getElementById('sendMessageBtn').disabled = true;
            return;
        }

        if (message !== '') {
            axios.post('api/chat/send', {
                sender_id: loggedInUserId,
                receiver_id: ownerUserId,
                message: message,
                g_ID: goodsId,
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

                const chatMessagesContainer = document.getElementById('chatMessages');
                chatMessagesContainer.appendChild(document.createRange().createContextualFragment(formattedMessage));
                chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;

                // Clear the message input
                document.getElementById('messageInput').value = '';

                sessionStorage.removeItem('productDetailUrl');
                
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

        
    document.getElementById('messageInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });

     function displayLinkPreview(url) {
            linkPreview.getPreview(url)
                .then(function(data) {
                    // Display the preview information in the linkPreview element
                    $('#linkPreview').html(`
                        <div>
                            <p>Title: ${data.title}</p>
                            <p>Description: ${data.description}</p>
                            <p>Image: <img src="${data.image}" alt="Preview Image"></p>
                            <p>URL: <a href="${data.url}" target="_blank">${data.url}</a></p>
                        </div>
                    `);
                })
                .catch(function(error) {
                    console.error('Error fetching link preview:', error);
                });
    }

    const productDetailUrl = sessionStorage.getItem('productDetailUrl');
    const message = `Hello, I want to ask about this stuff you posted: ${productDetailUrl}`;
    $('#messageInput').val(message);

        // Display link preview when the page loads
    // displayLinkPreview(productDetailUrl);

    document.getElementById('sendMessageBtn').addEventListener('click', sendMessage);

    function makeClickableLinks(text) {
        // Find URLs and convert them into anchor tags
        text = text.replace(/(http?:\/\/\S+)/g, '<a href="$1" target="_blank">$1</a>');
        // Find email addresses and convert them into mailto links
        text = text.replace(/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/g, '<a href="mailto:$1">$1</a>');
        return text;
    }

    // Example usage:
    $(document).ready(function() {
        // Assuming chat messages are stored in elements with class "chat-message"
        $('.chat-message').each(function() {
            var message = $(this).html();
            $(this).html(makeClickableLinks(message));
        });
    });


</script>