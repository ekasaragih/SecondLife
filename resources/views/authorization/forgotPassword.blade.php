<head>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                <form id="password-reset-form" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Your Email</label>
                        <input type="email" id="email" name="us_email"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full text-white p-2 rounded-md hover:opacity-75 focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300"
                            style="background-color: #EC297B;">Recover password</button>
                    </div>
                </form>
                <div class="mt-4 text-sm text-gray-600 text-center">
                    <p>Remembered your password? <a href="login" class="hover:underline" style="color: #EC297B;">Back
                            to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function displayValidationMessage(inputId, message) {
            var inputElement = document.getElementById(inputId);
            var messageElement = document.createElement('span');
            messageElement.className = 'text-red-500 text-sm';
            messageElement.textContent = message;
            inputElement.parentNode.appendChild(messageElement);
        }

        function removeValidationMessage(inputId) {
            var inputElement = document.getElementById(inputId);
            var messageElement = inputElement.parentNode.querySelector('.text-red-500');
            if (messageElement) {
                messageElement.parentNode.removeChild(messageElement);
            }
        }

        $(document).ready(function () {
            $('#password-reset-form').on('submit', function (event) {
                event.preventDefault(); // Prevent form submission

                // Reset validation messages
                removeValidationMessage('email');

                // Validate email
                var email = $('#email').val();
                if (!validateEmail(email)) {
                    displayValidationMessage('email', 'Please enter a valid email address');
                    return; // Stop submission if email is invalid
                }

                // Send AJAX request
                $.ajax({
                    url: "{{ route('sendEmail') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        us_email: email
                    },
                    success: function (response) {
                        // Handle success
                        alert('A password reset link has been sent to your email.');
                    },
                    error: function (xhr) {
                        // Handle error
                        displayValidationMessage('email', 'Failed to send password reset email. Please try again.');
                    }
                });
            });
        });
    </script>
</body>