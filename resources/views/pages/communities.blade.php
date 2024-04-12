@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52] mb-2"><b>Share Your Thoughts</b></div>
        <div class="w-full mx-auto rounded">
            <form>
                <div class="mb-4">
                    <input type="textarea" id="post" name="post" class="w-full h-40 px-3 py-2 border-2 rounded-md ">
                </div>
                <button class="bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] font-bold py-2 px-4 rounded shadow">
                    Post
                </button>                  
            </form>
        </div>
        <div class="text-3xl text-[#F12E52] mt-5 mb-2"><b>See What's ☕ in the town</b></div>
        <div class="flex flex-wrap mt-5">
            <divn class="w-1/3">
                <div class="rounded-lg shadow-md p-3 border-2 m-1">
                    <h2 class="text-lg font-semibold mb-2">Help!</h2>
                    <p class="text-gray-600">Do you think it's worth to barter my corkcickle with a book called "Before the coffee gets cold", I really want to have this book and I can not find it in any bookstore</p>
                    <h2 class="underline">See More</h2>
                    <div class="flex flex-row items-center">
                        <span class="text-2xl text-[#F12E52] mr-1">&hearts;</span>
                        <h3>20</h3>
                    </div>
                    <div class="flex items-center border-t border-gray-400 p-2">
                        <img class="w-10 h-10 rounded-full mr-4" src="https://cdn.antaranews.com/cache/1200x800/2023/03/13/4E7F573F-B89D-40E4-AE6F-56C06AD96496.jpeg" alt="Profile Picture">
                        <h2 class="text-lg font-semibold">Jeno Lee</h2>
                        <h2 class="text-base text-gray-500">March 24, 2024</h2>
                      </div>
                </div>     
            </divn>
        </div>
        
        
    </div>
</div>

@include('utils.layouts.footer.footer')