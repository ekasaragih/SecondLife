@include('layouts.navbar.topnav')

@section('head')
@endsection

<div class="h-full bg-gray-200 pt-52">

    <div class="mx-12 bg-white dark:bg-gray-900 rounded-lg overflow-hidden shadow-lg">
        <div class="border-b p-4">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-1">
                    <div class="text-center">
                        <img class="h-32 w-32 rounded-full border-4 border-white dark:border-gray-800 mx-auto my-4"
                            src="https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg" alt="">
                        <div class="flex gap-2 px-2">
                            <button
                                class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My Goods
                            </button>
                            <button
                                class="py-2.5 px-5 flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My wishlist
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 m-5 flex flex-col justify-center">
                    <div class="text-3xl font-bold">Ocha Rara Jiji Wini
                        <span
                            class="ml-2 opacity-75 hover:text-secondary cursor-pointer transition-all ease-out duration-300"
                            title="Edit profile" id="editProfileButton">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="text-primary">@charajiwin</div>
                    <div class="py-2 mt-5">
                        <div class="inline-flex text-gray-700 dark:text-gray-300 items-center">
                            <svg class="h-5 w-5 text-gray-400 dark:text-gray-600 mr-1" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class=""
                                    d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                            </svg>
                            New York, NY
                            <span
                                class="ml-2 opacity-75 hover:text-secondary cursor-pointer hover:transition-all hover:ease-out hover:duration-300"
                                title="Change address" id="changeAddressButton">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden" id="editProfileCollapseMenu">
                <hr class="mt-8 border-gray-300 sm:mx-auto dark:border-gray-700" />
                <section>
                    <div class="max-w-2xl px-4 py-8 mx-auto">
                        <h2 class="mb-4 text-2xl font-bold text-[#F12E52]">Update profile</h2>
                        <form action="#">
                            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                                <div class="sm:col-span-2">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                        Name</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="Apple iMac 27&ldquo;" placeholder="Type product name" required="">
                                </div>
                                <div class="w-full">
                                    <label for="brand"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                    <input type="text" name="brand" id="brand"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="Apple" placeholder="Product brand" required="">
                                </div>
                                <div class="w-full">
                                    <label for="price"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                    <input type="number" name="price" id="price"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="2999" placeholder="$299" required="">
                                </div>
                                <div>
                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                    <select id="category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option selected="">Electronics</option>
                                        <option value="TV">TV/Monitors</option>
                                        <option value="PC">PC</option>
                                        <option value="GA">Gaming/Console</option>
                                        <option value="PH">Phones</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="item-weight"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item
                                        Weight (kg)</label>
                                    <input type="number" name="item-weight" id="item-weight"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        value="15" placeholder="Ex. 12" required="">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" rows="8"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Write a product description here...">Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US</textarea>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <button type="submit"
                                    class="text-black bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Update product
                                </button>
                                <button type="button"
                                    class="text-yellow-400 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Reset
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

            <div class="hidden" id="changeAddressCollapseMenu">
                <p>
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                    terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer
                    labore wes anderson cred nesciunt sapiente ea proident. Ad vegan
                    excepteur butcher vice lomo. Leggings occaecat craft beer
                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                    heard of them accusamus labore sustainable VHS. 3 wolf moon officia
                    aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                    nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a
                    bird on it squid single-origin coffee nulla assumenda shoreditch et.
                </p>
            </div>

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
        const editProfileButton = document.getElementById("editProfileButton");
        const changeAddressButton = document.getElementById("changeAddressButton");        
        const editProfileCollapseMenu = document.getElementById("editProfileCollapseMenu");
        const changeAddressCollapseMenu = document.getElementById("changeAddressCollapseMenu");

        // Toggle collapse menu visibility when change address button is clicked
        editProfileButton.addEventListener("click", function () {
            editProfileCollapseMenu.classList.toggle("hidden");
        });

        // Toggle collapse menu visibility when change address collapse button is clicked
        changeAddressButton.addEventListener("click", function () {
            changeAddressCollapseMenu.classList.toggle("hidden");
        });
    });
</script>