<head>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    @yield('head')
</head>

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
            <form action="{{ route('auth_authenticate') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="login" class="block text-sm font-medium text-gray-700">Email or Username</label>
                    <input type="text" id="login" name="login"
                        class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                </div>
                <div class="flex justify-between items-center mb-6">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3"> Remember me </label>
                    </div>
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