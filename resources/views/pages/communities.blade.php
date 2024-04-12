@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52] mb-2"><b>Share Your Thoughts</b></div>
        <div class="w-full mx-auto rounded">
            <form>
                <div class="mb-4">
                    <input type="textarea" id="post" name="post" class="w-full h-40 px-3 py-2 border-2 rounded-md ">
                </div>
            </form>
        </div>
        <div class="text-3xl text-[#F12E52] mt-5 mb-2"><b>See What's ☕ in the town</b></div>
        <div class="flex flex-wrap mt-5">
            <div class="w-1/3 rounded-lg shadow-md p-3 border-2 my-5">
                <!-- Card content -->
                <h2 class="text-lg font-semibold mb-2">Help!</h2>
                <p class="text-gray-600">Do you think it's worth to barter my corkcickle with a book called "Before the coffee gets cold", I really want to have this book and I can not find it in any bookstore</p>
                <div class="flex flex-row items-center">
                    <span class="text-2xl text-[#F12E52] mr-1">&hearts;</span>
                    <h3>20</h3>
                </div>
                <h2 class="underlined">See More</h2>
            </div>     
            <div class="w-1/3 rounded-lg shadow-md p-3 border-2">
                <!-- Card content -->
                <h2 class="text-lg font-semibold mb-2">Help!</h2>
                <p class="text-gray-600">Do you think it's worth to barter my corkcickle with a book called "Before the coffee gets cold", I really want to have this book and I can not find it in any bookstore</p>
                <div class="flex flex-row items-center">
                    <span class="text-2xl text-[#F12E52] mr-1">&hearts;</span>
                    <h3>20</h3>
                </div>
                <h2 class="underlined">See More</h2>
            </div>               
        </div>
        
        
    </div>
</div>

@include('utils.layouts.footer.footer')