@extends('utils.layouts.navbar.topnav')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
    <meta name="api-token" content="{{ Auth::user()->api_token }}">
    @endauth
</head>

<div class="pt-52 mb-5 font-rubik">
    <div class="container mx-auto mb-5">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h1 class="text-2xl font-semibold mb-4">Goods Confirmation</h1>
            <div class="mb-4">
                <p class="text-lg">List of goods you need to confirm for exchange:</p>
                <ul class="list-disc pl-5">
                    <!-- List items should go here -->
                    <li>Item 1</li>
                    <li>Item 2</li>
                </ul>
            </div>
            <div>
                <p class="text-lg">List of goods that are waiting for user's approval to be confirmed:</p>
                <ul class="list-disc pl-5">
                    <!-- List items should go here -->
                    <li>Item A</li>
                    <li>Item B</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@include('utils.layouts.footer.footer')