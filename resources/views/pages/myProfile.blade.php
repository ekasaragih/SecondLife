@include('utils.layouts.navbar.topnav')

@section('head')
@endsection

<div class="pt-52 mb-24">

    <div class="mx-12 bg-white rounded-lg overflow-hidden shadow-lg">
        <div class="border-b p-4">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-1">
                    <div class="text-center">
                        <img class="h-32 w-32 rounded-full border-4 border-white mx-auto my-4"
                            src="https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg" alt="">
                        <div class="flex gap-2 px-2">
                            <a href="{{ route('my_goods') }}" title="My Goods"
                                class="p-3 text-center flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My Goods
                            </a>
                            <a href="" title="My Wishlist"
                                class="p-3 text-center flex-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                My Wishlist
                            </a>
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
                    <a href="#" class="text-gray-500 underline text-sm mt-2 italic">Change password</a>
                    <div class="py-2 mt-5">
                        <div class="inline-flex text-gray-700 items-center">
                            <svg class="h-5 w-5 text-gray-400 mr-1" fill="currentColor"
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

            @include('utils.user.modalEditProfile')
            @include('utils.user.modalChangeAddress')

        </div>
    </div>
</div>

@include('utils.layouts.footer.footer')
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

         editProfileButton.addEventListener("click", function () {
            editProfileCollapseMenu.classList.toggle("hidden");
            changeAddressCollapseMenu.classList.add("hidden");
        });

        changeAddressButton.addEventListener("click", function () {
            changeAddressCollapseMenu.classList.toggle("hidden");
            editProfileCollapseMenu.classList.add("hidden");
        });
    });
</script>