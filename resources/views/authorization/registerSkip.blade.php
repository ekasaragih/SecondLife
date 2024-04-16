<head>
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="tailwind.css">
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    @yield('head')
</head>

<div class="flex h-full">
    <!-- Left Pane -->
    <div class="h-full flex justify-start items-center">
        <img src="asset/img/login-base.png" class="h-full" alt="Login Image">
    </div>

    <!-- Right Pane -->
    <div class="h-full lg:w-1/2 flex items-center justify-center p-5">
        <div class="max-w-md w-full p-6">
            <h1 class="text-3xl font-semibold mb-6 text-black text-center">Let us know more about you!</h1>
            <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">
                You can fill this now or skip it.
            </h1>

            <div class="space-y-4">

                {{-- <div>
                    <label for="us_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="us_name" name="us_name" placeholder="Second Life"
                        class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                </div> --}}
                <div>
                    <label for="us_DOB" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" id="us_username" name="us_DOB"
                        class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                </div>
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                    <select id="gender" name="us_gender"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                        <option selected value="None">None</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Rather not to say">Rather not to say</option>
                    </select>
                </div>
                <div>
                    <label for="electronic" class="block text-sm font-medium text-gray-700">What do you like?</label>
                    <div class="text-xs my-2 text-gray-400">Please choose to maximum 3 categories.</div>
                    <ul class="grid w-full gap-2 md:grid-cols-4">
                        <li>
                            <input type="checkbox" id="electronic" value="" class="hidden peer" required="">
                            <label for="electronic"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Electronic
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="fashion" value="" class="hidden peer">
                            <label for="fashion"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Fashion
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="skincare" value="" class="hidden peer">
                            <label for="skincare"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Skincare
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="tools" value="" class="hidden peer">
                            <label for="tools"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Tools
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="household" value="" class="hidden peer">
                            <label for="household"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Household
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="colections" value="" class="hidden peer">
                            <label for="colections"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Collections
                            </label>
                        </li>
                    </ul>
                </div>
                <div>
                    <label for="electronic" class="block text-sm font-medium text-gray-700">What is your
                        barterwish?</label>
                    <div class="text-xs my-2 text-gray-400">Please choose to maximum 3 goods.</div>
                    <ul class="grid w-full gap-2 md:grid-cols-3">
                        <li>
                            <input type="checkbox" id="skintific" value="" class="hidden peer" required="">
                            <label for="skintific"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Skintific Serum
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="sweater" value="" class="hidden peer">
                            <label for="sweater"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Sweater 'This is April'
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="eye_shadow" value="" class="hidden peer">
                            <label for="eye_shadow"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Eye Shadow
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="ladder" value="" class="hidden peer">
                            <label for="ladder"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Ladder step
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="jeans" value="" class="hidden peer">
                            <label for="jeans"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Highwaist Jeans
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="ovsz_tee" value="" class="hidden peer">
                            <label for="ovsz_tee"
                                class="text-sm inline-flex items-center w-full p-2 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:font-semibold hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                Oversize Tee
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="flex mt-4 md:mt-6">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Save now
                    </button>
                    <button type="button"
                        class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        Skip for now
                    </button>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-600 text-center">
                <p>Already have an account? <a href="login" class="hover:underline" style="color: #EC297B;">Login
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>