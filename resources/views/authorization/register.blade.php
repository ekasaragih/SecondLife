<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="flex">
        <!-- Left Pane -->
        <div class="h-screen flex justify-start items-center">
            <img src="asset/img/login-base.png" class="h-full" alt="Login Image">
        </div>

        <!-- Right Pane -->
        <div class="w-full lg:w-1/2 flex items-center justify-center mt-10">
            <div class="max-w-md w-full p-6">
                <h1 class="text-3xl font-semibold mb-6 text-black text-center">Create your account!</h1>
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
                <form id="registration-form" action="/register" method="POST" class="space-y-4 mt-8" onsubmit="handleSubmit(event)">
                    @csrf
                    <!-- Full Name -->
                    <div>
                        <label for="us_name" class="block text-sm font-medium text-gray-700">
                            Full Name
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="us_name" name="us_name" placeholder="Second Life" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <!-- Username -->
                    <div>
                        <label for="us_username" class="block text-sm font-medium text-gray-700">
                            Username
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="us_username" name="us_username" placeholder="second_life" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="us_email" class="block text-sm font-medium text-gray-700">
                            Email
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="us_email" name="us_email" placeholder="user@secondlife.com" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <!-- Password -->
                    <div class="mt-4 relative">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="********" class="mt-1 p-2 pr-10 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                            <button type="button" onclick="togglePasswordVisibility('password')" class="absolute inset-y-0 right-0 flex items-center pr-3 focus:outline-none">
                                <i class="fa fa-eye-slash text-gray-400" id="password-icon" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="mt-4 relative">
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700">
                            Confirm Password
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="********" class="mt-1 p-2 pr-10 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                            <button type="button" onclick="togglePasswordVisibility('confirm_password')" class="absolute inset-y-0 right-0 flex items-center pr-3 focus:outline-none">
                                <i class="fa fa-eye-slash text-gray-400" id="confirm_password-icon" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-10">
                        <button type="submit" class="w-full text-white p-2 rounded-md hover:opacity-75 bg-[#EC297B] focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Create Account</button>
                    </div>
                </form>
                <!-- Link to Login -->
                <div class="mt-4 text-sm text-gray-600 text-center">
                    <p>Already have an account? <a href="login" class="hover:underline text-[#EC297B]">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to validate email format
        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        // Function to check if password meets criteria
        function validatePassword(password) {
            if (password.length < 8) {
                return "Minimum password length is 8 characters";
            }
            if (!/[A-Z]/.test(password)) {
                return "Password must contain at least one capital letter";
            }
            if (!/\d/.test(password)) {
                return "Password must contain at least one number";
            }
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

        // Error message mapping
        const errorMessages = {
            'us_name': 'Full name',
            'us_username': 'Username',
            'us_email': 'Email',
            'password': 'Password',
            'confirm_password': 'Confirm password'
        };

        // Function to handle form submission
        function handleSubmit(event) {
            event.preventDefault(); // Prevent form submission

            // Reset validation messages
            var inputIds = ['us_name', 'us_username', 'us_email', 'password', 'confirm_password'];
            inputIds.forEach(function(inputId) {
                removeValidationMessage(inputId);
            });

            // Validate full name
            var fullName = document.getElementById('us_name').value;
            if (fullName.length > 250) {
                displayValidationMessage('us_name', 'Full name exceed the max characters');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Full name exceed the max characters',
                });
                return;
            }

            // Validate username
            var username = document.getElementById('us_username').value;
            if (username.length > 12) {
                displayValidationMessage('us_username', 'Username exceed the max characters');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Username exceed the max characters',
                });
                return;
            }

            // Validate email
            var email = document.getElementById('us_email').value;
            if (!validateEmail(email)) {
                displayValidationMessage('us_email', 'Email format is not correct');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Email format is not correct',
                });
                return;
            }

            // Validate password
            var password = document.getElementById('password').value;
            var passwordValidationMessage = validatePassword(password);
            if (passwordValidationMessage) {
                displayValidationMessage('password', passwordValidationMessage);
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: passwordValidationMessage,
                });
                return;
            }

            // Confirm password
            var confirmPassword = document.getElementById('confirm_password').value;
            if (password !== confirmPassword) {
                displayValidationMessage('confirm_password', 'Password confirmed is not the same as password field');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Password confirmed is not the same as password field',
                });
                return;
            }

            // If all validations pass, proceed with form submission
            $.ajax({
                url: event.target.action,
                method: 'POST',
                data: $(event.target).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: 'You have been registered successfully!',
                    }).then(() => {
                        window.location.href = '/login'; // Redirect to login page after successful registration
                    });
                },
                error: function(response) {
                    if (response.responseJSON && response.responseJSON.errors) {
                        // Assuming response contains errors in responseJSON.errors
                        var errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            var error = errors[key][0];
                            var friendlyMessage = errorMessages[key] || key;
                            displayValidationMessage(key, friendlyMessage + ' ' + error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: friendlyMessage + ' ' + error,
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred during registration',
                        });
                    }
                }
            });
        }

        // Function to toggle password visibility
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            var passwordIcon = document.getElementById(inputId + '-icon');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = "password";
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>
