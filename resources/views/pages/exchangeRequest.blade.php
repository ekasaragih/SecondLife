@extends('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="shortcut icon" href="/asset/img/mini-logo.png" type="image/x-icon">
</head>
<div class="pt-52 mb-5 font-rubik">

    <div class="container mx-auto mb-5">
        <div class="text-3xl text-[#F12E52]"><b>Goods confirmation</b> <p class="text-lg">List of goods that are waiting for user's approval to be confirmed:</p></div><br>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="mb-4">
               

                @if($requestExchanges->isEmpty())
                <p class="text-center text-gray-500">No goods need confirmation at this time.</p>
                @else
                <ul class="list-disc pl-5">
                    @foreach ($requestExchanges as $exchange)
                    <li class="mb-6 border-b border-gray-200 pb-6">
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-8">
                                <div class="flex space-x-4">
                                    <div>
                                        <p class="font-semibold">My Goods:</p>
                                        <a href="/exchange-request"
                                            class="flex flex-col w-48 h-64 items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                                            <div class="flex flex-col justify-between p-4 leading-normal my-auto">
                                                <div class="flex space-x-2">
                                                    @foreach ($exchange->userGoods->goodsImages as $image)
                                                    <img src="{{ asset('goods_img/' . $image->img_url) }}"
                                                        alt="{{ $exchange->userGoods->g_name }}"
                                                        class="w-20 h-20 mx-auto border border-1 object-cover rounded-lg">
                                                    @endforeach
                                                </div>
                                                <p class="text-primary text-center mt-5">{{
                                                    $exchange->userGoods->g_name
                                                    }}</p>

                                                {{-- (ini nanti mau di get based on username aja) --}}
                                                <p class="text-center">From:
                                                    <span class="italic bold">{{
                                                        $exchange->userGoods->userID->us_username
                                                        }}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div>
                                        <p class="font-semibold">Goods Offered:</p>
                                        <a href="/exchange-request"
                                            class="flex flex-col w-48 h-64 items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                                            <div class="flex flex-col justify-between p-4 leading-normal my-auto">
                                                <div class="flex space-x-2">
                                                    @foreach ($exchange->otherUserGoods->goodsImages as $image)
                                                    <img src="{{ asset('goods_img/' . $image->img_url) }}"
                                                        alt="{{ $exchange->otherUserGoods->g_name }}"
                                                        class="w-20 h-20 mx-auto border border-1 object-cover rounded-lg">
                                                    @endforeach
                                                </div>
                                                <p class="text-primary text-center mt-5">{{
                                                    $exchange->otherUserGoods->g_name
                                                    }}</p>

                                                {{-- (ini nanti mau di get based on username aja) --}}
                                                <p class="text-center">From:
                                                    <span class="italic bold">{{
                                                        $exchange->otherUserGoods->userID->us_username
                                                        }}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-4">
    <p class="font-semibold">Status:</p>
    <div class="flex items-center">
    <span class="text-xs font-semibold px-2 py-1 uppercase rounded-full {{ $exchange->status === 'pending' ? 'bg-red-500 text-white' : ($exchange->status === 'confirmed' ? 'bg-green-500 text-white' : 'bg-purple-500 text-white') }}">
            {{ ucfirst($exchange->status) }}
        </span>
    </div>
</div>

                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="pt-42 mb-5 font-rubik">

    <div class="container mx-auto mb-5">
        <div class="text-3xl text-[#F12E52]"><b>Goods confirmation</b><p class="text-lg">List of goods you need to confirm for exchange:</p></div><br>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div>
                
                @if($pendingExchanges->isEmpty())
                <p class="text-center text-gray-500">No goods need confirmation at this time.</p>
                @else
                <ul class="list-disc pl-5">
                    @foreach ($pendingExchanges as $exchange)
                    <li class="mb-6 border-b border-gray-200 pb-6">
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-8">
                                <div class="flex space-x-4">
                                    <div>
                                        <p class="font-semibold">Other user goods:</p>
                                        <a href="/exchange-request"
                                            class="flex flex-col w-48 h-64 items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                                            <div class="flex flex-col justify-between p-4 leading-normal my-auto">
                                                <div class="flex space-x-2">
                                                    @foreach ($exchange->userGoods->goodsImages as $image)
                                                    <img src="{{ asset('goods_img/' . $image->img_url) }}"
                                                        alt="{{ $exchange->userGoods->g_name }}"
                                                        class="w-20 h-20 mx-auto border border-1 object-cover rounded-lg">
                                                    @endforeach
                                                </div>
                                                <p class="text-primary text-center mt-5">{{
                                                    $exchange->userGoods->g_name
                                                    }}</p>

                                                {{-- (ini nanti mau di get based on username aja) --}}
                                                <p class="text-center">From:
                                                    <span class="italic bold">{{
                                                        $exchange->userGoods->userID->us_username
                                                        }}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div>
                                        <p class="font-semibold">My goods:</p>
                                        <a href="/exchange-request"
                                            class="flex flex-col w-48 h-64 items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                                            <div class="flex flex-col justify-between p-4 leading-normal my-auto">
                                                <div class="flex space-x-2">
                                                    @foreach ($exchange->otherUserGoods->goodsImages as $image)
                                                    <img src="{{ asset('goods_img/' . $image->img_url) }}"
                                                        alt="{{ $exchange->otherUserGoods->g_name }}"
                                                        class="w-20 h-20 mx-auto border border-1 object-cover rounded-lg">
                                                    @endforeach
                                                </div>
                                                <p class="text-primary text-center mt-5">{{
                                                    $exchange->otherUserGoods->g_name
                                                    }}</p>

                                                {{-- (ini nanti mau di get based on username aja) --}}
                                                <p class="text-center pt-3">From:
                                                    <span class="italic bold">{{
                                                        $exchange->otherUserGoods->userID->us_username
                                                        }}</span>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <div class="flex space-x-4">
                                    <button onclick="handleConfirm({{ $exchange->ex_ID }})"
                                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Confirm</button>
                                    <button onclick="handleReject({{ $exchange->ex_ID }})"
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Reject</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>


@include('utils.layouts.footer.footer')


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function handleConfirm(exchangeId) {
        axios.post(`/api/exchange/confirm/${exchangeId}`, {}, {
            headers: {
                'Authorization': `Bearer ${document.querySelector('meta[name="api-token"]').content}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            alert('Exchange confirmed');
            location.reload();
        })
        .catch(error => {
            console.error(error);
            alert('An error occurred. Please try again.');
        });
    }

    function handleReject(exchangeId) {
        axios.post(`/api/exchange/reject/${exchangeId}`, {}, {
            headers: {
                'Authorization': `Bearer ${document.querySelector('meta[name="api-token"]').content}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            alert('Exchange rejected');
            location.reload();
        })
        .catch(error => {
            console.error(error);
            alert('An error occurred. Please try again.');
        });
    }
</script>