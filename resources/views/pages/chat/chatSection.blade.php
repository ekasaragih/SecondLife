@include('utils.layouts.navbar.topnav')

<!-- component -->
<div class="pt-48">

    <div class="container mx-auto">
        <div class="py-6 h-screen">
            <div class="flex border border-grey rounded shadow-lg h-full">

                <!-- Left -->
                <div class="w-1/3 border flex flex-col">
                    <!-- Header -->
                    @include('utils.chat.header')

                    <!-- Search -->
                    @include('utils.chat.search')

                    <!-- Contacts -->
                    @include('utils.chat.contacts')
                </div>


                <!-- Right -->
                <div class="w-2/3 border flex flex-col">

                    <!-- Header -->
                    @include('utils.chat.chatHeader')

                    <!-- Messages -->
                    @include('utils.chat.messages')

                    <!-- Input -->
                    @include('utils.chat.inputChat')
                </div>

            </div>
        </div>
    </div>
</div>