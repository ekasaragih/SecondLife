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
        <h2 class="text-3xl font-semibold text-purple-600 mb-3">Exchange Details</h2>
        <h2 class="text-xl font-semibold text-red-600 mb-6">Update this after you have exchanged the goods with other
            barterers</h2>

        <div>Update status:</div>
        <div>
            <form id="updateStatusForm">
                @csrf

                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select id="status" name="status" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="Awaiting Confirmation" {{ $exchange->status == 'Accepted' ?
                            'selected' : '' }}>Accepted</option>
                        <option value="Rejected" {{ $exchange->status == 'Rejected' ? 'selected' : '' }}>Rejected
                        </option>
                        <option value="Shipping" {{ $exchange->status == 'Shipping' ? 'selected' : '' }}>Shipping
                        </option>
                        <option value="Canceled Meeting" {{ $exchange->status == 'Canceled Meeting' ? 'selected' : ''
                            }}>Canceled Meeting</option>
                        <option value="Goods Received" {{ $exchange->status == 'Goods Received' ? 'selected' : ''
                            }}>Goods Received
                        </option>
                        <option value="Completed" {{ $exchange->status == 'Completed' ? 'selected' : '' }}>Completed
                        </option>
                    </select>
                </div>

                <div class="mb-4 hidden" id="reason-reject-field">
                    <label for="reason_reject" class="block text-gray-700">Reason for Rejection</label>
                    <div>{{ trim($exchange->reason_reject) }}</div>
                    <select id="reason_reject" name="reason_reject"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="">Select a reason</option>
                        <option value="Product is broken" {{ trim($exchange->reason_reject) == 'Product is broken' ?
                            'selected' : '' }}>
                            Product is broken
                        </option>
                        <option value="Product is not as described" {{ trim($exchange->reason_reject) == 'Product is not
                            as described' ?
                            'selected' : '' }}>
                            Product is not as described
                        </option>
                        <option value="Product is damaged" {{ trim($exchange->reason_reject) == 'Product is damaged' ?
                            'selected' : ''
                            }}>
                            Product is damaged
                        </option>
                        <option value="Product is expired" {{ trim($exchange->reason_reject) == 'Product is expired' ?
                            'selected' : ''
                            }}>
                            Product is expired
                        </option>
                        <option value="Product is missing parts" {{ trim($exchange->reason_reject) === 'Product is
                            missing parts' ?
                            'selected' : '' }}>
                            Product is missing parts
                        </option>
                        <option value="Received wrong product" {{ trim($exchange->reason_reject) == 'Received wrong
                            product' ?
                            'selected' : '' }}>
                            Received wrong product
                        </option>
                        <option value="Delayed delivery" {{ trim($exchange->reason_reject) == 'Delayed delivery' ?
                            'selected' : '' }}>
                            Delayed delivery
                        </option>
                        <option value="Found a better deal" {{ trim($exchange->reason_reject) == 'Found a better deal' ?
                            'selected' : ''
                            }}>
                            Found a better deal
                        </option>
                        <option value="Changed my mind" {{ trim($exchange->reason_reject) == 'Changed my mind' ?
                            'selected' : '' }}>
                            Changed my mind
                        </option>
                        <option value="Other" {{ trim($exchange->reason_reject) == 'Other' ? 'selected' : '' }}>
                            Other
                        </option>
                    </select>
                </div>

                <div id="date-fields" class="hidden">
                    <div class="mb-4">
                        <label for="meet_up_at" class="block text-gray-700">Meet Up Date</label>
                        <input type="date" id="meet_up_at" name="meet_up_at"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="exchanged_at" class="block text-gray-700">Exchange Date</label>
                        <input type="date" id="exchanged_at" name="exchanged_at"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-md">Update Status</button>
                </div>
            </form>
        </div>

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
                    <p class="text-sm font-semibold text-gray-700 mt-4">Current Price Est.: Rp {{
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
                    <p class="text-sm font-semibold text-gray-700 mt-4">Current Price Est.: Rp {{
                        number_format($otherUserGoods->g_price_prediction, 0, ',', '.') }}</p>
                </div>
            </div>

        </div>
        @include('utils.layouts.footer.footer')
    </div>


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

<script>
    $(document).ready(function() {
        $('#status').on('change', function() {
            var status = $(this).val();
            if (status === 'Completed') {
                $('#date-fields').removeClass('hidden');
                $('#reason-reject-field').addClass('hidden');
            } else if (status === 'Rejected') {
                $('#date-fields').removeClass('hidden');
                $('#reason-reject-field').removeClass('hidden');
            } else {
                $('#reason-reject-field').addClass('hidden');
                $('#date-fields').addClass('hidden');
            }
        });

        // Trigger change event initially to set fields visibility based on the initial status
        $('#status').trigger('change');

        $('#updateStatusForm').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var exchangeId = "{{ $exchange->ex_ID }}";
            var actionUrl = "/api/exchange/" + exchangeId + "/updateStatus";
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Authorization': 'Bearer ' + $('meta[name="api-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update status.',
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred.',
                    });
                }
            });
        });
    });

</script>