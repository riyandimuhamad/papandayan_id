<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'papandayan_id') }} - Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AlpineJS for Dropdowns/Modals -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-slate-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col transition-all duration-300 z-20 hidden md:flex shrink-0">
            <!-- Logo Area -->
            <div class="h-16 flex items-center justify-center border-b border-slate-800 px-4 py-4">
                <a href="{{ route('dashboard') }}" class="flex items-center w-full justify-center">
                    <img src="{{ asset('images/logo_wide.png') }}" alt="Papandayan Indonesia" class="h-10 w-auto object-contain">
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-yellow-500 text-slate-900 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                
                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Manajemen</p>
                </div>

                <a href="{{ route('admin.packages.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.packages.*') ? 'bg-yellow-500 text-slate-900 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                    Paket Pendakian
                </a>
                <a href="{{ route('admin.guides.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.guides.*') ? 'bg-yellow-500 text-slate-900 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Tim Pemandu
                </a>
                <a href="{{ route('admin.articles.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.articles.*') ? 'bg-yellow-500 text-slate-900 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Artikel Blog
                </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-yellow-500 text-slate-900 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->routeIs('admin.testimonials.*') ? 'text-slate-900' : 'text-slate-400 group-hover:text-yellow-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        Testimoni
                    </a>
                    
                    <a href="{{ route('admin.documentations.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.documentations.*') ? 'bg-yellow-500 text-slate-900 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="mr-3 flex-shrink-0 h-5 w-5 {{ request()->routeIs('admin.documentations.*') ? 'text-slate-900' : 'text-slate-400 group-hover:text-yellow-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Dokumentasi
                    </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tampilan Web</p>
                </div>
                
                <a href="{{ route('admin.hero-slides.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.hero-slides.*') ? 'bg-yellow-500 text-slate-900 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Slider Beranda
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-yellow-500 text-slate-900 shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Pengaturan
                </a>
            </nav>
            
            <!-- Ke Web Utama -->
            <div class="px-3 pb-3">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center justify-center px-4 py-2.5 text-sm font-bold rounded-lg bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-white transition-all shadow-sm border border-slate-700 hover:border-slate-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Lihat Web Utama
                </a>
            </div>

            <!-- User Section (Bottom) -->
            <div class="border-t border-slate-800 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-yellow-500 text-slate-900 flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 z-10 shrink-0">
                <!-- Mobile menu button (placeholder) -->
                <button class="md:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                
                <!-- Page Title -->
                <div class="flex-1 px-4">
                    <h1 class="text-xl font-bold text-gray-800 tracking-tight">
                        @yield('header_title', 'Admin Panel')
                    </h1>
                </div>

                <!-- Header Right -->
                <div class="flex items-center gap-4">
                    <!-- Dropdown using AlpineJS -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 focus:outline-none transition-colors">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" x-transition.opacity style="display: none;" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
