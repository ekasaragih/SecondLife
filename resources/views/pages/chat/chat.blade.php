<!-- chat_page.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barter Chat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold">Barter Chat</h1>
            <p class="text-gray-600">Chat with the Goods Owner</p>
        </div>

        <!-- Chat Messages -->
        <div id="chatMessages" class="max-w-lg mx-auto mb-8 overflow-y-auto max-h-80"></div>

        <!-- Input Form -->
        <div class="flex">
            <input type="text" id="messageInput"
                class="w-full px-4 py-2 mr-2 focus:outline-none focus:ring focus:border-blue-300 border-gray-300 rounded-lg"
                placeholder="Type your message...">
            <button id="sendMessageBtn" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Send</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function sendMessage() {
            const message = document.getElementById('messageInput').value.trim();
            if (message !== '') {
              
                axios.post('api/chat/send', {
                    sender_id: loggedInUserId,
                    receiver_id: ownerUserId,
                    message: message
                })
                .then(function (response) {
                
                    const formattedMessage = `
                        <div class="mb-4">
                            <div class="text-right text-gray-600">
                                You • ${moment().format('LT')}
                            </div>
                            <div class="bg-blue-500 text-white py-2 px-4 rounded-lg inline-block">
                                ${message}
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
</body>

</html>