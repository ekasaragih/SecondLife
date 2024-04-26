@include('utils.layouts.navbar.topnav')

<div class="flex justify-center h-screen pt-48 font-rubik">
    <div class="container w-4/5">

        <div class="text-3xl text-[#F12E52]"><b>Product Detail</b></div>

        <section class="text-gray-700 body-font overflow-hidden bg-white">
            <div class="my-10 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <img alt="ecommerce"
                        class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200"
                        src="https://www.whitmorerarebooks.com/pictures/medium/2465.jpg">
                    <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">PRODUCT NAME</h2>
                        <h1 class="text-primary text-3xl title-font mb-1 font-semibold">{{ $product->g_name }}</h1>

                        <p class="leading-relaxed">{{ $product->g_desc }}</p>
                        <div class="py-2">
                            <span class="mr-3">Category:</span>
                            <span class="">{{ $product->g_category }}</span>
                        </div>
                        <div class="flex border-b-2 border-gray-200 mb-5">
                            <div class="mb-4">
                                <span class="mr-3">Type:</span>
                                <span class="font-semibold text-secondary">{{ $product->g_type }}</span>
                            </div>

                        </div>
                        <div class="flex">
                            <div>
                                <span class="title-font font-medium text-xl text-gray-900">
                                    Prediction price:
                                </span>
                                <span class="text-base">
                                    {{ $product->g_price_prediction }}
                                </span>
                            </div>
                            <button
                                class="lex ml-auto text-white bg-red-500 border-0 py-2 px-2 text-sm focus:outline-none hover:bg-red-600 rounded transition duration-300"
                                data-modal-target="modalTermsAndCondition" data-modal-toggle="modalTermsAndCondition">
                                Click to Barter
                            </button>

                            <button
                                class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4 add-to-wishlist"
                                title="Add to wishlist" id="btn_add_wishlist" data-product-id="{{ $product->g_ID }}"
                                data-user-id="{{ $authenticatedUser->us_ID }}">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    class="w-5 h-5" viewBox="0 0 24 24">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>

{{-- T&C Modal --}}
@include('utils.categories.modalTermsAndCondition')

{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="/js/moment.js"></script>
<script>
    import {
            Modal
        } from 'flowbite';
</script>
<script>
    function addToWishlist(productId, userId) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        var data = {
            g_ID: productId,
            us_ID: userId,
        };

        $.ajax({
            url: 'api/wishlist/store',
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Authorization': 'Bearer ' + apiToken
            },
            data: data,
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                } else {
                    if (data.message.includes('already added')) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops...',
                            text: data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });
    }

    $(document).on('click', '.add-to-wishlist', function() {
        var productId = $(this).data('product-id');
        var userId = $(this).data('user-id');
        addToWishlist(productId, userId);
    });
</script>