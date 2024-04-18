<head>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('head')
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
                <h1 class="text-3xl font-semibold mb-6 text-black text-center">Welcome back!</h1>
                <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">
                    See what is going on with your business
                </h1>

                <div class="m-5">
                    <div class="flex items-center mb-4">
                        <div class="flex-1 border-b border-gray-300"></div>
                        <p class="mx-4">Sign in with Email</p>
                        <div class="flex-1 border-b border-gray-300"></div>
                    </div>
                </div>
                <form action="{{ route('login') }}" method="POST" class="space-y-4" onsubmit="handleSubmit(event)">
                    @csrf
                    <div>
                        <label for="us_username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="us_username" name="us_username"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <div class="flex justify-between items-center mb-6">
                        <!-- Checkbox -->
                        {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                            <label class="form-check-label" for="form1Example3"> Remember me </label>
                        </div> --}}
                        <a href="#" style="color: #EC297B;">Forgot password?</a>
                    </div>
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full text-white p-2 rounded-md hover:opacity-75 focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300"
                            style="background-color: #EC297B;">Sign Up</button>
                    </div>
                </form>
                <div class="mt-4 text-sm text-gray-600 text-center">
                    <p>Don't have an account? <a href="register" class="hover:underline" style="color: #EC297B;">Create
                            Account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script>
    // Function to validate email format
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        // Function to check if password meets criteria
        function validatePassword(password) {
            // Password length check
            if (password.length < 8) {
                return "Minimum password length is 8 characters";
            }
            // Password contains a capital letter check
            if (!/[A-Z]/.test(password)) {
                return "Password must contain at least one capital letter";
            }
            // Password contains a number check
            if (!/\d/.test(password)) {
                return "Password must contain at least one number";
            }

            // // Password contains an underscore check
            // if (!/_/.test(password)) {
            //     return "Password must contain at least one underscore";
            // }

            // No special characters check
            if (/[^a-zA-Z0-9_]/.test(password)) {
                return "Password must not consist of special characters, including (){}[]|`¬¦! \"£$%^&*\"<>:;#~_-+=,@";
            }
            return null; // Password meets all criteria
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
            removeValidationMessage('us_username');
            removeValidationMessage('password');

            // Validate email
            var email = document.getElementById('us_username').value;
            if (!validateEmail(email)) {
                displayValidationMessage('us_username', 'Please include an \'@\' in the email address');
                return; // Stop submission if email is invalid
            }

            // Validate password
            var password = document.getElementById('password').value;
            var passwordValidationMessage = validatePassword(password);
            if (passwordValidationMessage) {
                displayValidationMessage('password', passwordValidationMessage);
                return; // Stop submission if password is invalid
            }

            // If both email and password are valid, proceed with form submission
            event.target.submit();
        }
</script>