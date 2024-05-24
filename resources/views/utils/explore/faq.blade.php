@extends('utils.layouts.navbar.topnav')

<head>
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
    <style>
        .faq-card {
            perspective: 1000px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 120px;
        }

        .inner {
            transition: transform 0.5s;
            transform-style: preserve-3d;
            height: auto;
            display: flex;
            transition: transform 0.5s;
            transform-style: preserve-3d;
            flex-direction: column;
            /* Membuat konten vertikal di tengah */
        }

        .faq-card.flip .inner {
            transform: rotateY(180deg);
        }

        .front,
        .back {
            width: 100%;
            position: absolute;
            backface-visibility: hidden;
            padding: 10px;
            display: flex;
            /* Membuat konten vertikal di tengah */
            flex-direction: column;
            /* Membuat konten vertikal di tengah */
            justify-content: center;
            /* Posisi vertikal ke tengah */
        }

        .back {
            transform: rotateY(180deg);
        }
    </style>
</head>

<div class="flex items-center justify-center pt-52">
    <div class="container w-4/5">
        <div class="my-0 text-secondary flex items-center">
            <div>
                <h1 class="text-3xl text-[#F12E52] font-bold mb-4">Welcome to our FAQ!</h1>
            </div>
        </div>
        <p class="text-lg md:text-xl">Answers to your Frequently Asked Questions! Click to your preferable questions!
        </p>

        <div class="container mx-auto mt-8 mb-8">
            <!-- Added mb-8 (margin-bottom: 8) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- FAQ Item 1 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800 ml-4">What is SecondLife?</h2>
                            <!-- Added margin for spacing -->
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">SecondLife is a web-based platform for bartering.
                                This website adopts the ancient theme of bartering and implements it into the modern
                                era, which is a website.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">What features are available here?
                            </h2>
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">We provide features that make it easier for
                                barterers to search for items based on location, trends, and categories. We also offer
                                an auto prediction price feature to help you estimate the best price for the items you
                                upload. Additionally, we provide a swape feature to facilitate barterers in finding
                                suitable items. And also chat and community features for communication.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Swape feature?</h2>
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">The Swape feature is designed to make it easier for
                                barterers to select preferred items with just one swipe! Where swiping to the right will
                                add the product to the wishlist and swiping to the left means not interested.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto mt-8 mb-8">
            <!-- Added mb-8 (margin-bottom: 8) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- FAQ Item 4 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Recommendation by Location?</h2>
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">This feature provides convenience for barterers to
                                search for other barterers who are near your current location or the location you are
                                currently searching for.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Featured Products?</h2>
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">This feature helps barterers find products that are
                                currently popular and trending among other barterers as well.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Current Price Est.?</h2>
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">This feature assists barterers in estimating the
                                price of items based on predefined options.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto mt-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- FAQ Item 7 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Communities feature?</h2>
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">Community feature serves as a platform for
                                barterers to engage in communication with each other, fostering a sense of community and
                                enabling them to share discussions, opinions, and insights. It provides a space where
                                individuals can connect, interact, and build relationships with fellow barterers.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 8 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Chat feature?</h2>
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">Community feature serves as a platform for
                                barterers to engage in communication with each other, fostering a sense of community and
                                enabling them to share discussions, opinions, and insights. It provides a space where
                                individuals can connect, interact, and build relationships with fellow barterers.</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 9 -->
                <div class="faq-card h-40" onclick="this.classList.toggle('flip')">
                    <div class="inner rounded-lg transition-transform duration-500 ease-in-out transform">
                        <div class="front p-6 bg-white flex items-center justify-center">
                            <!-- Added classes to center content -->
                            <img class="mx-auto w-20 h-20 object-cover" src="/asset/img/barter_success_2.png" alt="" />
                            <!-- Added image -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Barter flow?</h2>
                        </div>
                        <div class="back p-6 bg-white">
                            <p class="text-gray-700 leading-relaxed">
                                In the barter flow, barterers are recommended to add items to their wishlist before
                                clicking "to barter," where they must agree to the terms and conditions. After agreeing,
                                they will be redirected to a chat interface for negotiations between the barterers. This
                                flow ensures that barterers have the opportunity to review their selections and agree on
                                the terms before proceeding to the negotiation stage, promoting transparency and
                                facilitating smooth transactions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('utils.layouts.footer.footer')