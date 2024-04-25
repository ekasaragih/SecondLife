<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
    <link rel="stylesheet" href="/asset/css/imgContainer.css">
</head>

@include('utils.layouts.navbar.topnav')
<div class="flex justify-center h-screen pt-52">
    <div class="container w-4/5">
        <div class="text-3xl text-[#F12E52] mb-2"><b>Share Your Thoughts</b></div>
        <div class="w-full mx-auto rounded">
            <form id="addCommunityPost">
                @csrf
                <div class="mb-4 border-2 rounded-md">
                    <input type="text" id="community_title" name="community_title"
                        class="w-full px-3 py-2 border-b border-gray-300 font-semibold" placeholder="Title">
                    <input type="textarea" id="community_desc" name="community_desc" class="w-full h-40 px-3 py-2 pt-0"
                        placeholder="Share your thoughts">
                </div>
                <button type="submit" id="btn-community-post"
                    class="bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] font-bold py-2 px-4 rounded shadow">
                    Post
                </button>
            </form>
        </div>

        <div class="text-3xl text-[#F12E52] mt-5 mb-2"><b>See What's ☕ in the town</b></div>
        <div class="h-screen flex flex-col justify-between">
            @auth
                @foreach ($communities as $community)
                    <div id="post-card" class="mt-5 mb-5">
                        <div id="post" class="rounded-lg shadow-md p-3 border-2 m-1">
                            <div class="flex items-center p-3">
                                <img class="w-8 h-8 rounded-full mr-4"
                                    src="https://cdn.antaranews.com/cache/1200x800/2023/03/13/4E7F573F-B89D-40E4-AE6F-56C06AD96496.jpeg"
                                    alt="Profile Picture">
                                <h2 class="text-lg font-semibold mr-3">{{ $community->UserID->us_name }}</h2>
                                <h2 class="text-base text-gray-500 italic">
                                    {{ \Carbon\Carbon::parse($community->created_at)->format('F j, Y') }}</h2>
                            </div>
                            <h2 class="text-lg font-semibold mb-2 pl-3">{{ $community->community_title }}</h2>
                            <p class="text-gray-800 pl-3">{{ $community->community_desc }}</p>
                            <div class="flex flex-row items-center pl-3">
                                <span class="text-2xl text-[#F12E52] mr-1">&hearts;</span>
                                <h3>20</h3>
                            </div>
                        </div>

                        <div class="w-11/12 float-right">
                            <form class="addCommunityFeedback" data-community-id="{{ $community->community_ID }}">
                                @csrf
                                <b class="text-lg text-[#F12E52] underline">Add Your Replies</b>
                                <input type="hidden" id="community_ID" name="community_ID"
                                    value="{{ $community->community_ID }}">
                                <div class="mt-3 mb-3 border-2 rounded-md">
                                    <input type="textarea" id="feedback_desc" name="feedback_desc"
                                        class="w-full h-20 px-3 py-2 pt-0" placeholder="Give your replies">
                                </div>
                                <button type="submit" id="btn-community-feedback"
                                    class="bg-[#F12E52] hover:bg-white text-white hover:text-[#F12E52] font-bold py-2 px-4 rounded shadow">
                                    Comment
                                </button>
                            </form>
                        </div>
                        @foreach ($feedbacks as $feedback)
                            @if ($feedback->community_ID === $community->community_ID)
                                <div id="replies"
                                    class="w-11/12 rounded-lg shadow-md p-5 border-2 m-1 float-right flex items-center">
                                    <img class="w-8 h-8 rounded-full mr-4"
                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUAl5RnJ7_Y5MWYXPkxtFAM5eahD7k9RjDDQ&s"
                                        alt="Profile Picture">
                                    <h2 class="text-lg font-semibold mr-3">{{ $feedback->UserID->us_name }}</h2>
                                    <h2 class="text-base text-gray-500 italic">
                                        {{ \Carbon\Carbon::parse($feedback->created_at)->format('F j, Y') }}</h2>
                                    <p class="text-gray-800 pl-3">{{ $feedback->feedback_desc }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            @else
                <p class="my-5">Please <a href="/login"
                        class="underline font-semibold hover:text-primary duration-200 translate-x-2">log in</a> to see
                    communities.</p>
            @endauth
        </div>
        {{-- footer nya ga dibawah --}}
        {{-- @include('utils.layouts.footer.footer') --}}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addCommunityPost = document.getElementById('addCommunityPost');
        // const addCommunityFeedback = document.getElementById('addCommunityFeedback');
        const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        $('#btn-community-post').click(function(event) {
            event.preventDefault();

            var community = {
                community_title: $("#community_title").val(),
                community_desc: $("#community_desc").val(),
            }

            $.ajax({
                url: '{{ route('add_my_community_post') }}',
                type: 'POST',
                data: community,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + apiToken
                },
                success: function(response) {
                    console.log('response: ', response);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your post added successfully!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            });
        });

        $('.addCommunityFeedback').submit(function(event) {
            event.preventDefault();

            var communityID = $(this).find('input[name="community_ID"]').val();

            var feedback = {
                community_ID: communityID,
                feedback_desc: $(this).find('input[name="feedback_desc"]').val(),
            }

            $.ajax({
                url: '{{ route('add_my_community_feedback') }}',
                type: 'POST',
                data: feedback,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + apiToken
                },
                success: function(response) {
                    console.log('response: ', response);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your comment added successfully!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                            console.log(feedback);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            });
        });

    });

    // Get the wishlist count element
    const wishlistCount = document.getElementById('wishlist-count');

    // Get the wishlist from the local storage
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    // Update the wishlist count
    wishlistCount.textContent = wishlist.length;

    // Add an event listener to the remove button to update the wishlist count
    const removeButtons = document.querySelectorAll('.remove-button');
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const index = button.dataset.index;
            wishlist = wishlist.filter(item => item.index !== index);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            wishlistCount.textContent = wishlist.length;
        });
    });
</script>
