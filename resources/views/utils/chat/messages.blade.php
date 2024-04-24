<div class="flex-1 overflow-auto" style="background-color: #DAD3CC">
    <div class="py-2 px-3">

        <div class="flex justify-center mb-4">
            <div class="rounded py-2 px-4" style="background-color: #FCF4CB">
                <p class="text-xs">
                    Please be careful in sharing personal information to ensure your safety.
                </p>
            </div>
        </div>

        <div id="productDetails" class="hidden">
            <div class="flex justify-center mb-4">
                <div class="rounded py-2 px-3 bg-[#F2F2F2] w-96">
                    <p class="text-sm mt-1">
                        Product Name: <span id="productNames"></span><br>
                        Description: <span id="productDescs"></span><br>
                        Category: <span id="productCategorys"></span><br>
                        Type: <span id="productTypes"></span><br>
                        Price: <span id="productPrices"></span>
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-center mb-2">
            <div class="rounded py-2 px-4" style="background-color: #DDECF2">
                <p class="text-sm uppercase">
                    April 19, 2024
                </p>
            </div>
        </div>

        {{-- Chat from logged in user --}}
        <div id="chatMessages"></div>

        {{-- Display chat messages --}}
        @foreach($chatMessages as $message)
        @if($message->sender_id == $loggedInUserId)
        {{-- Right section chat from logged in user --}}
        <div class="flex justify-end mb-2">
            <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
                <p class="text-sm mt-1">
                    {{ $message->content }}
                </p>
                <p class="text-right text-xs text-grey-dark mt-1">
                    You • {{ $message->created_at->format('d/m/Y H:i') }} {{-- Adjust the date format as needed --}}
                </p>
            </div>
        </div>
        @else
        {{-- Left section chat from other user --}}
        <div class="flex mb-2">
            <div class="rounded py-2 px-3" style="background-color: #F2F2F2">
                <p class="text-sm mt-1">
                    {{ $message->content }}
                </p>
                <p class="text-right text-xs text-grey-dark mt-1">
                    {{ $message->sender_name }} • {{ $message->created_at->format('d/m/Y H:i') }} {{-- Adjust the date
                    format as
                    needed --}}
                </p>
            </div>
        </div>
        @endif
        @endforeach



    </div>
</div>

{{-- <script>
    function displayProductDetails() {
        // Retrieve product details from the modal
        const productName = $('#productName').text();
        const productDesc = $('#productDesc').text();
        const productCategory = $('#productCategory').text();
        const productType = $('#productType').text();
        const productPrice = $('#productPrice').text();
        
        // Populate the product details into the designated elements
        $('#productDetails #productNames').text(productName);
        $('#productDetails #productDescs').text(productDesc);
        $('#productDetails #productCategorys').text(productCategory);
        $('#productDetails #productTypes').text(productType);
        $('#productDetails #productPrices').text(productPrice);
        
        // Show the product details section
        $('#productDetails').removeClass('hidden');
    }

    displayProductDetails();
</script> --}}