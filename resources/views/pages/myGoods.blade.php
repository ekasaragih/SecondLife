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
                <span data-modal-target="modalAddGoods" data-modal-toggle="modalAddGoods"
                    class="flex text-lg items-center justify-center m-2 p-2 bg-[#F12E52] hover:bg-white text-white
                hover:text-[#F12E52] shadow-lg rounded-md float-right">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </div>

            @include('utils.myGoods.modalAddGoods')
            @include('utils.myGoods.modalEditGoods')


            @if (count($goods) > 0)
                @foreach ($goods as $goods)
                    <div id="Goods"
                        class="w-full rounded-lg shadow-md p-5 border-2 space-y-2 float-right flex items-center z-0 mb-5">
                        @foreach ($goods->images as $image)
                            <img class="w-32 h-32 rounded-none m-4" src="{{ asset('storage/' . $image->img_url) }}"
                                alt="Goods Image">
                        @endforeach
                        <div class="w-3/4 m-4 pl-3 relative">
                            <div class="flex">
                                <h3 class="text-base text-gray-500 italic mr-1">{{ $goods->g_category }}</h3>
                                <h3 class="text-base text-gray-500 italic mr-1"> - </h3>
                                <h3 class="text-base text-gray-500 italic mr-1">{{ $goods->g_type }}</h3>
                            </div>
                            <h2 class="text-2xl font-bold">{{ $goods->g_name }}</h2>
                            <span class=""><i class="fa fa-map-marker mr-2" aria-hidden="true"></i>South
                                Jakarta</span>
                            <p class="text-gray-800">{{ $goods->g_desc }}</p>
                            <div class="flex">
                                <h3 class="text-base text-gray-600 mr-1">Price Prediction: </h3>
                                <h3 class="text-base text-gray-600 mr-1"> {{ $goods->g_price_prediction }} </h3>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                                <button class="edit-btn" data-modal-target="modalEditGoods"
                                    data-modal-toggle="modalEditGoods">
                                    <span><i class="fa fa-pencil mr-1" aria-hidden="true"></i> Edit </span>
                                </button>
                            </div>
                            <div
                                class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                                <button class="delete-btn" data-goods-id="{{ $goods->g_ID }}">
                                    <span><i class="fa fa-trash mr-1" aria-hidden="true"></i> Delete </span>
                                </button>
                            </div>
                            {{-- <div
                                class="p-2 m-1 bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] shadow-lg rounded-md">
                                <a href="">
                                    <span data-modal-target="modalEditGoods" data-modal-toggle="modalEditGoods"><i
                                            class="fa fa-pencil mr-1" aria-hidden="true"></i> Edit </span>
                                </a>
                            </div> --}}
                        </div>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    import {
        Modal
    } from 'flowbite';
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const goodsId = this.dataset.goodsId;
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this item!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            fetch(`/my-goods/delete/${goodsId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => {
                                    if (response.ok) {
                                        swal("Success!", "Item deleted successfully.",
                                            "success");
                                        setTimeout(function() {
                                            location.reload();
                                        }, 2000);
                                    } else {
                                        throw new Error('Failed to delete item.');
                                    }
                                })
                                .catch(error => {
                                    console.error(error);
                                    alert('Failed to delete item.');
                                });
                        } else {
                            // User clicked the "Cancel" button in SweetAlert
                            swal("Your item is safe!", {
                                icon: "info",
                            });
                        }
                    });
            });
        });
    });
</script>
