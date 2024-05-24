@include('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="pt-52 mb-5 font-rubik">
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold text-purple-600 mb-6">Exchange Details</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- User Goods -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img class="w-full h-64 object-cover object-center"
                    src="{{ optional($userGoods->images->first())->img_url ? asset('goods_img/' . $userGoods->images->first()->img_url) : '' }}"
                    alt="User Goods Image">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-purple-600 mb-2 border-b-2 border-purple-800 pb-2">{{
                        $userGoods->g_name }}</h3>
                    <p class="text-sm text-gray-600 mb-1">{{ $userGoods->g_desc }}</p>
                    <p class="text-sm text-gray-500 mt-2">Category: {{ $userGoods->g_category }}</p>
                    <p class="text-sm font-semibold text-gray-700 mt-4">Price Prediction: Rp {{
                        number_format($userGoods->g_price_prediction, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Other User Goods -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img class="w-full h-64 object-cover object-center"
                    src="{{ optional($otherUserGoods->images->first())->img_url ? asset('goods_img/' . $otherUserGoods->images->first()->img_url) : '' }}"
                    alt="Other User Goods Image">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-purple-600 mb-2 border-b-2 border-purple-800 pb-2">{{
                        $otherUserGoods->g_name }}</h3>
                    <p class="text-sm text-gray-600 mb-1">{{ $otherUserGoods->g_desc }}</p>
                    <p class="text-sm text-gray-500 mt-2">Category: {{ $otherUserGoods->g_category }}</p>
                    <p class="text-sm font-semibold text-gray-700 mt-4">Price Prediction: Rp {{
                        number_format($otherUserGoods->g_price_prediction, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    @include('utils.layouts.footer.footer')
</div>

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="/js/moment.js"></script>
<script>
    import {
        Modal
    } from 'flowbite';
</script>