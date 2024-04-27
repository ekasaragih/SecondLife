@extends('utils.layouts.navbar.topnav')

<div class="flex justify-center h-screen pt-52">
    @if ($goods->isEmpty())
        <p class="text-xl text-gray-600">Product Not Found</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($goods as $good)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $good->images->first()->img_url ?? 'https://via.placeholder.com/400' }}" alt="Product Image">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $good->g_name }}</h3>
                        <p class="text-sm text-gray-600">{{ $good->g_desc }}</p>
                        <div class="mt-2 flex justify-between items-center">
                            <p class="text-sm text-gray-500">Category: {{ $good->g_category }}</p>
                            <p class="text-sm text-gray-500">Age: {{ $good->g_age }} Years</p>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <p class="text-sm font-semibold text-gray-700">Price: Rp {{ number_format($good->g_original_price, 0, ',', '.') }}</p>
                            <a href="{{ route('goods_detail', ['id' => $good->g_ID]) }}" class="text-sm font-medium text-purple-600 hover:text-purple-800">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@include('utils.layouts.footer.footer')
