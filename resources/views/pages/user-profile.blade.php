@include('layouts.navbar.topnav')

@section('head')
@endsection

<div class="h-screen dark:bg-gray-700 bg-gray-200 pt-52">

    <div class="mx-12 bg-white dark:bg-gray-900 rounded-lg overflow-hidden shadow-lg">
        <div class="border-b p-4">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-1">
                    <div class="text-center">
                        <img class="h-32 w-32 rounded-full border-4 border-white dark:border-gray-800 mx-auto my-4"
                            src="https://i.pinimg.com/564x/9d/d2/90/9dd2906190f0c1813429fe0c8695ed04.jpg" alt="">

                    </div>
                </div>

                <div class="col-span-3 m-5 flex flex-col justify-center">
                    <div class="text-3xl font-bold">Ocha Rara Jiji Wini
                        <span
                            class="ml-2 opacity-75 hover:text-secondary cursor-pointer transition-all ease-out duration-300">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="text-primary">@charajiwin</div>
                    <div class="py-2">
                        <div class="inline-flex text-gray-700 dark:text-gray-300 items-center">
                            <svg class="h-5 w-5 text-gray-400 dark:text-gray-600 mr-1" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class=""
                                    d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                            </svg>
                            New York, NY
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>


</div>


{{--
|--------------------------------------------------------------------------
| SCRIPTS
|--------------------------------------------------------------------------
--}}
<script></script>