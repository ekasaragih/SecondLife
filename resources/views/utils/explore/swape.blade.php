<head>
    <style>
        /* Custom styles */
        .carousel-item-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1rem;
            background-color: rgba(0, 0, 0, 0.5);
            color: #ffffff;
        }

        .carousel-item-caption p {
            margin: 0;
        }
    </style>
</head>


<div class="grid grid-cols-4 gap-4">

    <div class="col-span-1">
        <div class="text-3xl text-[#F12E52]"><b>Swape</b></div>
        <div class="text-xl mt-4 italic">
            Swap your goods by swiping!
            Swipe to the right for match and left to unmatch!
        </div>
        <div class="mt-6 text-gray-600">Find your perfect match now!</div>
        <div class="mt-4">
            <img src="https://png.pngtree.com/png-clipart/20200707/ourlarge/pngtree-mobile-phone-like-3d-element-png-image_2285401.jpg"
                class="w-40 h-40 rounded-full border-2 border-white" alt="Your Image">
        </div>
    </div>

    <div class="col-span-3 place-items-center p-6 bg-white border border-black rounded-lg shadow-lg">
        <div id="carousel-example" class="relative w-full">

            <div class="relative h-64 overflow-hidden rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                <div id="carousel-item-1" class="duration-700 ease-in-out transition-transform">
                    <img src="https://i.pinimg.com/474x/1f/30/3f/1f303fa4b944cceb075fd97c73c5866f.jpg"
                        class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full"
                        alt="..." />
                    <div class="carousel-item-caption">
                        <p>Product 1</p>
                    </div>
                </div>

                <div id="carousel-item-2" class="duration-700 ease-in-out transition-transform hidden">
                    <img src="https://i.pinimg.com/474x/11/eb/0b/11eb0bf731fd8065ab42141b61993190.jpg"
                        class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full"
                        alt="..." />
                    <div class="carousel-item-caption">
                        <p>Product 2</p>
                    </div>
                </div>

                <div id="carousel-item-3" class="duration-700 ease-in-out transition-transform hidden">
                    <img src="https://i.pinimg.com/474x/b1/ca/d8/b1cad8824753b38e9652369c0cbb7dce.jpg"
                        class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full"
                        alt="..." />
                    <div class="carousel-item-caption">
                        <p>Product 3</p>
                    </div>
                </div>

                <div id="carousel-item-4" class="duration-700 ease-in-out transition-transform hidden">
                    <img src="https://i.pinimg.com/474x/4b/2a/a1/4b2aa13f207a44a2f3b76d66cd0a469a.jpg"
                        class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full"
                        alt="..." />
                    <div class="carousel-item-caption">
                        <p>Product 4</p>
                    </div>
                </div>
            </div>

            <button id="data-carousel-prev" type="button"
                class="group absolute left-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                <span
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white">
                    <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="hidden">Previous</span>
                </span>
            </button>
            <button id="data-carousel-next" type="button"
                class="group absolute right-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none">
                <span
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white">
                    <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="hidden">Next</span>
                </span>
            </button>
        </div>
    </div>
</div>

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const items = document.querySelectorAll('[id^="carousel-item-"]');
        const indicators = document.querySelectorAll('[id^="carousel-indicator-"]');
        const prevButton = document.getElementById("data-carousel-prev");
        const nextButton = document.getElementById("data-carousel-next");
        let currentIndex = 0;

       
        function showSlide(index) {
            items.forEach(item => item.classList.add("hidden"));
            indicators.forEach(indicator => indicator.setAttribute("aria-current", "false"));

            items[index].classList.remove("hidden");
            indicators[index].setAttribute("aria-current", "true");
        }

 
        function showNextSlide() {
            currentIndex = (currentIndex + 1) % items.length;
            showSlide(currentIndex);
        }

     
        function showPrevSlide() {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            showSlide(currentIndex);
        }

       
        nextButton.addEventListener("click", showNextSlide);
        prevButton.addEventListener("click", showPrevSlide);
    });
</script>