@extends('utils.layouts.navbar.topnav')

<div class="flex items-center justify-center pt-52">
    <div class="container w-4/5">
        <div class="my-0 text-secondary flex items-center">
            <div>
                <p>Welcome to SecondLife!</p>
            </div>
        </div>
        <div class="text-3xl text-[#F12E52]"><b>List of Products:</b></div>
        <div class="mt-6 text-gray-600">Find your perfect match now!</div>

        @if ($goods->isEmpty())
    <div class="flex flex-col items-center justify-center h-full">
        <p class="text-3xl text-gray-600 mb-4">Product Not Found</p>
        <div class="flex space-x-4">
            <a href="{{ route('about_us') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-md">Back to Home</a>
            <a href="{{ route('contact_us') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Contact Us</a>
        </div>
    </div>
@else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($goods as $good)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ $good->images->first()->img_url ?? 'https://via.placeholder.com/400' }}"
                    alt="Product Image">
                    <div class="p-4">
                <h3 class="text-lg font-semibold text-purple-600 mb-2 border-b-2 border-purple-800 pb-2"
                            style="height: 3.5rem; line-height: 1.75rem; /* Set to two lines of text */">{{ $good->g_name }}</h3>
                            <p class="text-sm text-gray-600 font-bold mb-1" style="height: 1.5rem; line-height: 1.5rem;">
                            Description:</p>
                        <p class="text-sm text-gray-600 mb-1"
                            style="height: 3rem; line-height: 1.5rem; overflow: hidden;">{{ $good->g_desc }}</p>
                    <div class="mt-2 flex justify-between items-center">
                        <p class="text-sm text-gray-500">Category: {{ $good->g_category }}</p>
                        <p class="text-sm text-gray-500">Age: {{ $good->g_age }} Years</p>
                    </div>
                    <hr class="my-4 border-b-2 border-gray-800"> <!-- Garis pembatas -->
<div class="mt-4 flex justify-between items-center">
    <span class="text-gray-600 text-xs font-bold order-last">Price Prediction: <br> Rp {{ number_format($good->g_price_prediction, 0, ',', '.') }}</span>
   <a href="{{ route('goods_detail', ['hashed_id' => Hashids::encode($good->g_ID)]) }}"
   class="inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-sm">Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@include('utils.layouts.footer.footer')