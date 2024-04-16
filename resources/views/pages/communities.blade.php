@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">
        <div class="text-3xl text-[#F12E52] mb-2"><b>Share Your Thoughts</b></div>
        <div class="w-full mx-auto rounded">
            <form>
                <div class="mb-4 border-2 rounded-md">
                    <input type="text" id="post" name="post"
                        class="w-full px-3 py-2 border-b border-gray-300 font-semibold" placeholder="Title">
                    <input type="textarea" id="post" name="post" class="w-full h-40 px-3 py-2 pt-0"
                        placeholder="Share your thoughts">
                </div>
                <button
                    class="bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] font-bold py-2 px-4 rounded shadow">
                    Post
                </button>
            </form>
        </div>
        <div class="text-3xl text-[#F12E52] mt-5 mb-2"><b>See What's ☕ in the town</b></div>
        <div id="post-card" class="mt-5">
            <div id="post" class="rounded-lg shadow-md p-3 border-2 m-1">
                <div class="flex items-center p-3">
                    <img class="w-8 h-8 rounded-full mr-4"
                        src="https://cdn.antaranews.com/cache/1200x800/2023/03/13/4E7F573F-B89D-40E4-AE6F-56C06AD96496.jpeg"
                        alt="Profile Picture">
                    <h2 class="text-lg font-semibold mr-3">Jeno Lee</h2>
                    <h2 class="text-base text-gray-500 italic">March 24, 2024</h2>
                </div>
                <h2 class="text-lg font-semibold mb-2 pl-3">Help!</h2>
                <p class="text-gray-800 pl-3">Do you think it's worth to barter my corkcickle with a book called "Before
                    the coffee gets cold", I really want to have this book and I can not find it in any bookstore</p>
                <div class="flex flex-row items-center pl-3">
                    <span class="text-2xl text-[#F12E52] mr-1">&hearts;</span>
                    <h3>20</h3>
                </div>
            </div>
            <div class="w-11/12 float-right">
                <form>
                    <b class="text-lg text-[#F12E52] underline">Add Your Replies</b>
                    <div class="mt-3 mb-3 border-2 rounded-md">
                        <input type="textarea" id="post" name="post" class="w-full h-20 px-3 py-2 pt-0"
                            placeholder="Give your replies">
                    </div>
                    <button
                        class="bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] font-bold py-2 px-4 rounded shadow">
                        Comment
                    </button>
                </form>
            </div>
            <div id="replies" class="w-11/12 rounded-lg shadow-md p-5 border-2 m-1 float-right flex items-center">
                <img class="w-8 h-8 rounded-full mr-4"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUAl5RnJ7_Y5MWYXPkxtFAM5eahD7k9RjDDQ&s"
                    alt="Profile Picture">
                <h2 class="text-lg font-semibold mr-3">Mark Lee</h2>
                <h2 class="text-base text-gray-500 italic">March 24, 2024</h2>
                <p class="text-gray-800 pl-3">YASHH! You're totally missing a lot</p>
            </div>
            <div id="replies" class="w-11/12 rounded-lg shadow-md p-5 border-2 m-1 float-right flex items-center">
                <img class="w-8 h-8 rounded-full mr-4"
                    src="https://i.pinimg.com/736x/cc/c3/e6/ccc3e6081e3b11da3eb6f16d625b45c9.jpg" alt="Profile Picture">
                <h2 class="text-lg font-semibold mr-3">Jisung Park</h2>
                <h2 class="text-base text-gray-500 italic">March 24, 2024</h2>
                <p class="text-gray-800 pl-3">I have that, wanna exchange?</p>
            </div>
        </div>
    </div>
</div>

<script>
     // Get the wishlist count element
     const wishlistCount = document.getElementById('wishlist-count');

    // Get the wishlist from the local storage
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    // Update the wishlist count
    wishlistCount.textContent = wishlist.length;

    // Add an event listener to the remove button to update the wishlist count
    const removeButtons = document.querySelectorAll('.remove-button');
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.dataset.index;
            wishlist = wishlist.filter(item => item.index !== index);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            wishlistCount.textContent = wishlist.length;
        });
    });

</script>

@include('utils.layouts.footer.footer')