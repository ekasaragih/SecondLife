@include('utils.layouts.navbar.topnav')

<div class="flex justify-center h-screen pt-48 pb-64 font-rubik">
    <div class="container w-4/5 mx-auto mt-10">
        <div class="text-3xl text-[#F12E52] mb-5"><b>Users Who Wishlisted This Item</b></div>
        
        <!-- Display product details -->
        <div class="my-10 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <div id="productImages" class="lg:w-1/2 w-full flex justify-center items-center">
                    <div class="flex items-center">
                        @foreach ($product->images as $image)
                        <img class="product-image hidden h-64 object-cover object-center"
                            src="{{ asset('goods_img/' . $image->img_url) }}">
                        @endforeach
                    </div>
                </div>
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">SECONDLIFE BARTER</h2>
                    <h1 class="text-primary text-3xl title-font mb-1 font-semibold">{{ $product->g_name }}</h1>
                    <p class="leading-relaxed text-gray-600">{{ $product->g_desc }}</p>

                    <!-- Tambahkan tabel pengguna yang memasukkan item keinginan di bawah deskripsi produk -->
                    @if($users->isEmpty())
                    <div class="mt-5 text-xl"><b>Wishlisted by:</b></div>
                    <p class="text-gray-600">No one has wishlisted this item yet.</p>
                    @else
                    <table class="table-auto w-full mt-5">
                        <thead>
                            <tr>
                                <th class="mt-5 text-xl px-4 py-2">Wishlisted by:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('userProfile', ['username' => $user->us_username]) }}" class="text-blue-500 hover:underline">
                                        {{ $user->us_username }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>  

@include('utils.layouts.footer.footer')
