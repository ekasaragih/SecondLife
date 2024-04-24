<div class="bg-grey-lighter flex-1 overflow-auto">

    {{-- Container untuk list of contacts --}}
    <div class="bg-white px-3 flex items-center hover:bg-grey-lighter cursor-pointer">
        {{-- Container untuk img --}}
        <div>
            <img class="h-12 w-12 rounded-full"
                src="https://i.pinimg.com/564x/a0/55/ee/a055eeaa4c31c142ff8d94a42e6939f2.jpg" />
        </div>
        <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
            <div class="flex items-bottom justify-between">
                <p class="text-grey-darkest">
                    {{-- Last user yang ngechat si logged in user --}}
                    Minyons
                </p>
                <p class="text-xs text-grey-darkest">
                    {{-- Waktu dari last message dari other user yang ngechat si logged in user --}}
                    12:45 pm
                </p>
            </div>
            <p class="text-grey-dark mt-1 text-sm">
                {{-- Last message dari other user yang ngechat si logged in user --}}
                Halo dek
            </p>
        </div>
    </div>

</div>