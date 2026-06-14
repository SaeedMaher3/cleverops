<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CleverOps') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#120030]">

<div x-data="{ sidebarOpen: true }" class="min-h-screen">

    @include('layouts.navigation')

    <div
        class="min-h-screen bg-[#F7F8FC] rounded-tl-[38px] relative overflow-hidden transition-all duration-300"
        :class="sidebarOpen ? 'ml-[300px]' : 'ml-0'"
    >

        <!-- Toggle Button -->
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="fixed z-[9999] bottom-8 w-12 h-12 rounded-full bg-gradient-to-r from-purple-600 to-fuchsia-500 text-white shadow-xl border-4 border-white transition-all duration-300 flex items-center justify-center"
            :class="sidebarOpen ? 'left-[276px]' : 'left-5'"
        >
            <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
            </svg>

            <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <!-- Top Right -->
        <div class="absolute top-6 right-10 z-50 flex items-center gap-7">

            <div class="w-[430px] relative">
                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-[#21005D] text-xl">🔍</span>

                <input
                    type="text"
                    placeholder="Search anything..."
                    class="w-full pl-14 pr-12 py-4 border-2 border-purple-100 rounded-[28px] bg-white shadow-[0_10px_30px_rgba(91,0,200,.08)] focus:outline-none focus:ring-2 focus:ring-purple-500">

                <span class="absolute right-5 top-1/2 -translate-y-1/2 text-[#21005D] text-2xl">⌕</span>
            </div>

            <div class="relative cursor-pointer">
                <div class="w-14 h-14 rounded-full bg-white shadow-[0_10px_25px_rgba(91,0,200,.12)] flex items-center justify-center text-2xl">
                    🔔
                </div>

                <span class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center">
                    3
                </span>
            </div>

            <div class="flex items-center gap-4">
                <img
                    src="{{ asset('images/logo (3).png') }}"
                    alt="Profile"
                    class="w-16 h-16 rounded-full border-4 border-purple-100 object-cover bg-white">

                <div>
                    <div class="font-extrabold text-[#21005D] text-lg">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-base text-[#21005D]/65">
                        Admin
                    </div>
                </div>

                <div class="text-[#21005D] text-xl">⌄</div>
            </div>

        </div>

        <main class="px-10 py-8">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>