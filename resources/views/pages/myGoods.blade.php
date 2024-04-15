@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52] mb-5">
            <b>My Goods</b>
            <a data-modal-target="modalAddGoods" data-modal-toggle="modalAddGoods" class="flex text-lg items-center justify-center m-2 p-2 bg-[#F12E52] hover:bg-white text-white
                hover:text-[#F12E52] shadow-lg rounded-md float-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>

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


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    import { Modal } from 'flowbite';
</script>

{{-- <script>
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
</script> --}}