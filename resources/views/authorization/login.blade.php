<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                        <p class="mx-4">Sign in with Username</p>
                        <div class="flex-1 border-b border-gray-300"></div>
                    </div>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-4" onsubmit="handleSubmit(event)">
                    @csrf
                    <div>
                        <label for="us_username" class="block text-sm font-medium text-gray-700">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="us_username" name="us_username"
                            class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <div class="mt-4 relative">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="mt-1 p-2 pr-10 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                            <button type="button" onclick="togglePasswordVisibility()"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 focus:outline-none">
                                <i class="fa fa-eye-slash text-gray-400" id="password-icon" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('forgotPassword')}}" style="color: #EC297B;">Forgot password?</a>
                    </div>
                    <div class="mt-10">
                        <button type="submit"
                            class="w-full text-white p-2 rounded-md hover:opacity-75 focus:outline-none focus:bg-black focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300"
                            style="background-color: #EC297B;">Sign In</button>
                    </div>
                </form>
                <div class="mt-4 text-sm text-gray-600 text-center">
                    <p>Don't have an account? <a href="register" class="hover:underline"
                            style="color: #EC297B;">Create Account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle password visibility
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var passwordIcon = document.getElementById('password-icon');
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

        // Function to handle form submission
        function handleSubmit(event) {
            event.preventDefault(); // Prevent form submission

            removeValidationMessage('us_username');
            removeValidationMessage('password');

            var username = document.getElementById('us_username').value;
            if (username.trim() === '') {
                displayValidationMessage('us_username', 'Please enter your username');
                return; 
            }

            var password = document.getElementById('password').value;
            if (password.trim() === '') {
                displayValidationMessage('password', 'Please enter your password');
                return;
            }

            event.target.submit();
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

        document.addEventListener("DOMContentLoaded", function() {
            @if($errors->has('login_error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ $errors->first('login_error') }}',
                });
            @endif
        });
    </script>
</body>
</html>
