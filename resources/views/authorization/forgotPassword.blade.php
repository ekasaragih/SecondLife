<head>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to validate email format
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        // Function to display validation messages
        function displayValidationMessage(inputId, message) {
            var inputElement = document.getElementById(inputId);
            var messageElement = document.createElement('span');
            messageElement.className = 'text-red-500 text-sm';
            messageElement.textContent = message;
            inputElement.parentNode.appendChild(messageElement);
        }

        // Function to remove validation messages
        function removeValidationMessage(inputId) {
            var inputElement = document.getElementById(inputId);
            var messageElement = inputElement.parentNode.querySelector('.text-red-500');
            if (messageElement) {
                messageElement.parentNode.removeChild(messageElement);
            }
        }

        // Function to handle form submission
        function handleSubmit(event) {
            event.preventDefault(); // Prevent form submission

            // Reset validation messages
            removeValidationMessage('email');

            // Validate email
            var email = document.getElementById('email').value;
            if (!validateEmail(email)) {
                displayValidationMessage('email', 'Please enter a valid email address');
                return; // Stop submission if email is invalid
            }

            // If email is valid, proceed with form submission
            event.target.submit();
        }
    </script>
</head>

<body>
    <div class="flex h-screen">
        <!-- Left Pane -->
        <div class="h-screen flex justify-start items-center">
            <img src="asset/img/login-base.png" class="h-full" alt="Login Image">
        </div>

        <!-- Right Pane -->
        <div class="w-full lg:w-1/2 flex items-center justify-center">
            <div class="max-w-md w-full p-6">
                <h1 class="text-3xl font-semibold mb-6 text-black text-center">Forgot your password?</h1>
                <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">
                    Don't panic! Just type in your email and we will send you a code to reset your password!
                </h1>

                <form action="#" method="POST" class="space-y-4" onsubmit="handleSubmit(event)">
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                {{ csrf_field() }}
                
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Your Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full text-white p-2 rounded-md hover:opacity-75 focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300"
                            style="background-color: #EC297B;">Recover password</button>
                    </div>
                </form>
                <div class="mt-4 text-sm text-gray-600 text-center">
                    <p>Remembered your password? <a href="login" class="hover:underline"
                            style="color: #EC297B;">Back
                            to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
