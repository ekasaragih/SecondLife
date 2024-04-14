@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52] mb-5">
            <b>My Goods</b>
            <div id="addGoodsButton" class="flex text-lg items-center justify-center m-2 p-2 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md float-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
        </div>
        
        <div id="addGoodsForm" class="z-50 hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
            <div class="max-w-md mx-auto bg-white rounded p-6 shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Upload Goods</h2>
                    <button id="closeForm" class="px-2 py-2 bg-red-500 text-white rounded-md">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name" class="mt-1 p-2 block w-full border-gray-300 rounded-md">
                    </div>
                    <div class="flex">
                        <div class="mb-4 mr-2">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="category" name="category" class="mt-1 p-2 block w-full border-gray-300 rounded-md">
                                <option value="electronics">Electronics</option>
                                <option value="clothing">Clothing</option>
                                <option value="books">Books</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select id="type" name="type" class="mt-1 p-2 block w-full border-gray-300 rounded-md">
                                <option value="new">New</option>
                                <option value="used">Used</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="3" class="mt-1 p-2 block w-full border-gray-300 rounded-md"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                        <input type="file" id="image" name="image" class="mt-1 p-2 block w-full border-gray-300 rounded-md">
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="py-2 px-4 bg-[#F12E52] text-white rounded hover:bg-white hover:text-[#F12E52]">Upload</button>
                    </div>
                </form>
            </div>
        </div>
                       

        <div id="Goods" class="w-full rounded-lg shadow-md p-5 border-2 m-1 float-right flex items-center z-0">
            <img class="w-32 h-32 rounded-none m-4" 
                src="https://m.media-amazon.com/images/I/61ZsGQimlQL._AC_UF894,1000_QL80_.jpg" 
                alt="Goods Image">
            <div class="w-3/4 m-4 pl-3 relative">
                <div class="flex">
                    <h3 class="text-base text-gray-500 italic mr-1">Electronic</h3>
                    <h3 class="text-base text-gray-500 italic mr-1"> - </h3>
                    <h3 class="text-base text-gray-500 italic mr-1">Used</h3>    
                </div>
                <h2 class="text-2xl font-bold">Airpods</h2>
                <span class=""><i class="fa fa-map-marker mr-2" aria-hidden="true"></i>South Jakarta</span>
                <p class="text-gray-800">Use it for 3 months and my iphone in broken now so i can't really use it anymore</p>
            </div>
            <div class="relative">
                <div class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                    <a href="">
                        <span><i class="fa fa-trash mr-1" aria-hidden="true"></i> Delete </span>
                    </a>
                </div>
                <div class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                    <a href="">
                        <span><i class="fa fa-pencil mr-1" aria-hidden="true"></i> Edit </span>
                    </a>
                </div>
            </div>
            {{-- <h2 class="text-lg font-semibold mr-3">Mark Lee</h2>
            <h2 class="text-base text-gray-500 italic">March 24, 2024</h2>
            <p class="text-gray-800 pl-3">YASHH! You're totally missing a lot</p> --}}
        </div>
        
    </div>
</div>

@include('utils.layouts.footer.footer')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addGoodsButton = document.getElementById("addGoodsButton");
        const addGoodsForm = document.getElementById("addGoodsForm");
        const closeForm = document.getElementById("closeForm");

        addGoodsButton.addEventListener("click", function() {
            addGoodsForm.classList.remove("hidden");
        });

        closeForm.addEventListener("click", function() {
            addGoodsForm.classList.add("hidden");
        });
    });
</script>