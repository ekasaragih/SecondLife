@include('utils.layouts.navbar.topnav')

<head>
    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" /> --}}
</head>

<div>
    <div class="flex justify-center h-screen pt-52 mb-96 pb-64">
        <div class="w-4/5 container pb-64">

            <div class="text-3xl text-[#F12E52] mb-5">
                <b>My Goods</b>
                <span data-modal-target="modalAddGoods" data-modal-toggle="modalAddGoods" class="flex text-lg items-center justify-center m-2 p-2 bg-[#F12E52] hover:bg-white text-white
                hover:text-[#F12E52] shadow-lg rounded-md float-right">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </div>

            @include('utils.myGoods.modalAddGoods')

            <div id="Goods" class="w-full rounded-lg shadow-md p-5 border-2 m-1 float-right flex items-center z-0">
                <img class="w-32 h-32 rounded-none m-4"
                    src="https://m.media-amazon.com/images/I/61ZsGQimlQL._AC_UF894,1000_QL80_.jpg" alt="Goods Image">
                <div class="w-3/4 m-4 pl-3 relative">
                    <div class="flex">
                        <h3 class="text-base text-gray-500 italic mr-1">Electronic</h3>
                        <h3 class="text-base text-gray-500 italic mr-1"> - </h3>
                        <h3 class="text-base text-gray-500 italic mr-1">Used</h3>
                    </div>
                    <h2 class="text-2xl font-bold">Airpods</h2>
                    <span class=""><i class="fa fa-map-marker mr-2" aria-hidden="true"></i>South Jakarta</span>
                    <p class="text-gray-800">Use it for 3 months and my iphone in broken now so i can't really use it
                        anymore</p>
                    <div class="flex">
                        <h3 class="text-base text-gray-600 mr-1">Price Prediction: </h3>
                        <h3 class="text-base text-gray-600 mr-1"> 500,000 </h3>
                    </div>
                </div>
                <div class="relative">
                    <div
                        class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                        <a href="">
                            <span><i class="fa fa-trash mr-1" aria-hidden="true"></i> Delete </span>
                        </a>
                    </div>
                    <div
                        class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                        <a href="">
                            <span><i class="fa fa-pencil mr-1" aria-hidden="true"></i> Edit </span>
                        </a>
                    </div>
                </div>
                {{-- <h2 class="text-lg font-semibold mr-3">Mark Lee</h2>
                <h2 class="text-base text-gray-500 italic">March 24, 2024</h2>
                <p class="text-gray-800 pl-3">YASHH! You're totally missing a lot</p> --}}
            </div>

            @if (count($goods)>0)
            @foreach ($goods as $goods)
            <div id="Goods"
                class="w-full rounded-lg shadow-md p-5 border-2 space-y-2 float-right flex items-center z-0 mb-5">
                <img class="w-32 h-32 rounded-none m-4"
                    src="https://m.media-amazon.com/images/I/61ZsGQimlQL._AC_UF894,1000_QL80_.jpg" alt="Goods Image">
                <div class="w-3/4 m-4 pl-3 relative">
                    <div class="flex">
                        <h3 class="text-base text-gray-500 italic mr-1">{{$goods->g_category}}</h3>
                        <h3 class="text-base text-gray-500 italic mr-1"> - </h3>
                        <h3 class="text-base text-gray-500 italic mr-1">{{$goods->g_type}}</h3>
                    </div>
                    <h2 class="text-2xl font-bold">{{$goods->g_name}}</h2>
                    <span class=""><i class="fa fa-map-marker mr-2" aria-hidden="true"></i>South Jakarta</span>
                    <p class="text-gray-800">{{$goods->g_desc}}</p>
                    <div class="flex">
                        <h3 class="text-base text-gray-600 mr-1">Price Prediction: </h3>
                        <h3 class="text-base text-gray-600 mr-1"> 500,000 </h3>
                    </div>
                </div>
                <div class="relative">
                    <div
                        class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                        <a href="">
                            <span><i class="fa fa-trash mr-1" aria-hidden="true"></i> Delete </span>
                        </a>
                    </div>
                    <div
                        class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                        <a href="">
                            <span><i class="fa fa-pencil mr-1" aria-hidden="true"></i> Edit </span>
                        </a>
                    </div>
                </div>
                {{-- <h2 class="text-lg font-semibold mr-3">Mark Lee</h2>
                <h2 class="text-base text-gray-500 italic">March 24, 2024</h2>
                <p class="text-gray-800 pl-3">YASHH! You're totally missing a lot</p> --}}
            </div>
            @endforeach
            @endif

            @include('utils.layouts.footer.footer')
        </div>

    </div>


</div>




{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    import { Modal } from 'flowbite';
</script>