@include('utils.layouts.navbar.topnav')

<head>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    @yield('head')
</head>

<section class="relative font-rubik h-screen pt-52 pb-100 font-rubik">
    <div class="py-8 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-secondary">Contact Us
        </h2>
        <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 sm:text-xl">Got a technical
            issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.</p>
        <form action="#" class="space-y-8 pb-10">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your
                    email</label>
                <input type="email" id="email"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="name@secondlife.com" required>
            </div>
            <div>
                <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Subject</label>
                <input type="text" id="subject"
                    class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500"
                    placeholder="Let us know how we can help you" required>
            </div>
            <div class="sm:col-span-2">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your
                    message</label>
                <textarea id="message" rows="6"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 "
                    placeholder="Leave a comment..."></textarea>
            </div>
            <button type="submit"
                class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-primary sm:w-fit hover:bg-opacity-75 focus:ring-4 focus:outline-none focus:ring-primary-300">Send
                message</button>
        </form>

        <a href="/"
            class="mt-16 text-sm font-medium text-center rounded-lg text-gray-500 underline sm:w-fit hover:text-opacity-75 focus:ring-4 focus:outline-none focus:ring-primary-300">Back
            to home</a>
    </div>
</section>