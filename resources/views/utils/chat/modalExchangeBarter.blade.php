<div id="modalExchangeBarter" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-[100rem] max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h2 class="text-2xl font-bold text-[#F12E52]">Select Product</h2>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modalExchangeBarter">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <div class="max-w-[100rem] px-4 py-8 mx-auto">

                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 my-3 shadow-md"
                        role="alert">
                        <div class="flex">
                            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                </svg></div>
                            <div>
                                <p class="font-bold">Select which goods you want to barter</p>
                                <p class="text-sm">(Please recheck the data carefully. You can't change it
                                    if you already confirmed it.)</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 flex justify-between">
                        {{-- Goods from user that logged in --}}
                        <div class="max-w-[45%] px-4">

                            <div>
                                <p class="font-bold top-0 mb-2">Your Goods:</p>
                                <input type="text" id="userGoodsSearch" placeholder="Search your goods..." class="px-3 py-2 border rounded-md w-full mr-2">
                                <ul id="userGoodsList" class="grid w-full gap-6 md:grid-cols-1">
                                    @foreach ($loggedInUserGoods as $goods)
                                    <li class="">
                                        <input type="checkbox" id="{{ $goods->g_ID }}" name="user_goods"
                                            value="{{ $goods->g_ID }}" class="hidden peer" required />
                                        <label for="{{ $goods->g_ID }}"
                                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">

                                            <div id="Goods"
                                                class="w-full rounded-lg shadow-md p-5 border-2 space-y-2 float-right flex items-center z-0 mb-5">
                                                @if ($goods->images->isNotEmpty())
                                                <img class="w-32 h-32 rounded-none m-4"
                                                    src="{{ asset('goods_img/' . $goods->images->first()->img_url) }}"
                                                    alt="Goods Image">
                                                @endif
                                                <div class="w-3/4 m-4 pl-3 relative">
                                                    <div>
                                                        <span class="text-base text-gray-500 italic mr-1">
                                                            {{ $goods->g_category }}
                                                        </span>
                                                        <span class="text-base text-gray-500 italic mr-1"> - </span>
                                                        <span class="text-base text-gray-500 italic mr-1 item-name">
                                                            {{ $goods->g_name }}
                                                        </span>
                                                    </div>
                                                    <h2 class="text-2xl font-bold">{{ $goods->g_name }}</h2>

                                                    <p class="text-gray-800">{{ $goods->g_desc }}</p>
                                                    <div class="flex">
                                                        <h3 class="text-base text-gray-600 mr-1">Price Prediction: </h3>
                                                        <h3 class="text-base text-gray-600 mr-1">
                                                            Rp. {{ number_format($goods->g_price_prediction, 0, '.',
                                                            ',') }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        {{-- Goods from user that the current user is chatting (goods owner id) --}}
                        <div class="max-w-[45%] px-4">
                            <div>
                                <p class="font-bold top-0 mb-2">Goods you favorited from {{ $ownerName }}:</p>
                                @if($wishlistGoods->isEmpty())
                                <p class="mb-6 italic text-red-500">No goods you favorited from this user or no
                                    available favorited goods from this user is available to be bartered.</p>
                                @else
                                <ul class="grid w-full gap-6 md:grid-cols-1 mb-10">
                                    @foreach ($wishlistGoods as $goods)
                                    <li class="">
                                        <input type="checkbox" id="{{ $goods->g_ID }}" name="other_user_goods"
                                            value="{{ $goods->g_ID }}" class="hidden peer" required />
                                        <label for="{{ $goods->g_ID }}"
                                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">

                                            <div id="Goods"
                                                class="w-full rounded-lg shadow-md p-5 border-2 space-y-2 float-right flex items-center z-0 mb-5">
                                                @if ($goods->images->isNotEmpty())
                                                <img class="w-32 h-32 rounded-none m-4"
                                                    src="{{ asset('goods_img/' . $goods->images->first()->img_url) }}"
                                                    alt="Goods Image">
                                                @endif
                                                <div class="w-3/4 m-4 pl-3 relative">
                                                    <div>
                                                        <span class="text-base text-gray-500 italic mr-1">
                                                            {{ $goods->g_category }}
                                                        </span>
                                                        <span class="text-base text-gray-500 italic mr-1"> - </span>
                                                        <span class="text-base text-gray-500 italic mr-1 item-name">
                                                            {{ $goods->g_name }}
                                                        </span>
                                                    </div>
                                                    <h2 class="text-2xl font-bold">{{ $goods->g_name }}</h2>

                                                    <p class="text-gray-800">{{ $goods->g_desc }}</p>
                                                    <div class="flex">
                                                        <h3 class="text-base text-gray-600 mr-1">Price Prediction: </h3>
                                                        <h3 class="text-base text-gray-600 mr-1">
                                                            Rp. {{ number_format($goods->g_price_prediction, 0, '.',
                                                            ',') }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </li>
                                    @endforeach

                                </ul>
                                @endif
                            </div>

                            <div>
                                <p class="font-bold top-0 mb-2">Goods from {{ $ownerName }}:</p>
                                @if($chattingUserGoods->isEmpty())
                                <p class="mb-6 italic text-red-500">No goods available from this user for bartering or
                                    you can select the goods from Goods you favorited.</p>
                                @else
                                <input type="text" id="ownerGoodsSearch" placeholder="Search owner's goods..." class="px-3 py-2 border rounded-md w-full">
                                <ul id="ownerGoodsList" class="grid w-full gap-6 md:grid-cols-1">
                                    @foreach ($chattingUserGoods as $goods)
                                    <li class="">
                                        <input type="checkbox" id="{{ $goods->g_ID }}" name="other_user_goods"
                                            value="{{ $goods->g_ID }}" class="hidden peer" required />
                                        <label for="{{ $goods->g_ID }}"
                                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">

                                            <div id="Goods"
                                                class="w-full rounded-lg shadow-md p-5 border-2 space-y-2 float-right flex items-center z-0 mb-5">
                                                @if ($goods->images->isNotEmpty())
                                                <img class="w-32 h-32 rounded-none m-4"
                                                    src="{{ asset('goods_img/' . $goods->images->first()->img_url) }}"
                                                    alt="Goods Image">
                                                @endif
                                                <div class="w-3/4 m-4 pl-3 relative">
                                                    <div>
                                                        <span class="text-base text-gray-500 italic mr-1">
                                                            {{ $goods->g_category }}
                                                        </span>
                                                        <span class="text-base text-gray-500 italic mr-1"> - </span>
                                                        <span class="text-base text-gray-500 italic mr-1 item-name">
                                                            {{ $goods->g_name }}
                                                        </span>
                                                    </div>
                                                    <h2 class="text-2xl font-bold">{{ $goods->g_name }}</h2>

                                                    <p class="text-gray-800">{{ $goods->g_desc }}</p>
                                                    <div class="flex">
                                                        <h3 class="text-base text-gray-600 mr-1">Price Prediction: </h3>
                                                        <h3 class="text-base text-gray-600 mr-1">
                                                            Rp. {{ number_format($goods->g_price_prediction, 0, '.',
                                                            ',') }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>

                                        </label>
                                    </li>
                                    @endforeach

                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center space-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" id="btn_send_exchange"
                    class="text-black bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Confirm
                </button>
                <button type="button" data-modal-hide="modalExchangeBarter"
                    class="text-yellow-400 inline-flex items-center hover:text-white border border-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
      // Function to filter user goods
      $('#userGoodsSearch').on('input', function() {
        const searchText = $(this).val().toLowerCase();
        $('#userGoodsList li').each(function() {
            const itemName = $(this).find('.item-name').text().toLowerCase();
            $(this).toggle(itemName.includes(searchText));
        });
    });

    // Function to filter owner goods
    $('#ownerGoodsSearch').on('input', function() {
        const searchText = $(this).val().toLowerCase();
        $('#ownerGoodsList li').each(function() {
            const itemName = $(this).find('.item-name').text().toLowerCase();
            $(this).toggle(itemName.includes(searchText));
        });
    });

    $('#btn_send_exchange').click(function () {
        confirmExchange();
    });

    function confirmExchange() {
        const loggedInUserId = {{ auth()->user()->us_ID }};
        const otherUserId = {{ $ownerUserId }};
        const userGoodsId = $('input[name="user_goods"]:checked').val();
        const otherUserGoodsId = $('input[name="other_user_goods"]:checked').val();

        if ($('input[name="user_goods"]:checked').length > 1 || $('input[name="other_user_goods"]:checked').length > 1 || $('input[name="wishlist_goods"]:checked').length > 1) {
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'You can only choose 1 goods for each user!'
            });
            return;
        }
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var apiToken = $('meta[name="api-token"]').attr('content');

        $.ajax({
            url: '/api/exchange/store',
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Authorization': 'Bearer ' + apiToken
            },
            data: {
                my_ID: loggedInUserId,
                goods_owner_ID: otherUserId,
                my_goods: userGoodsId,
                barter_with: otherUserGoodsId
            },
            success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: 'Exchange confirmed successfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '/categories';
                });

            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Failed to confirm exchange.');
            }
        });
    }

</script>
