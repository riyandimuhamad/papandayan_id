<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Admin - {{ config('app.name', 'papandayan_id') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="flex min-h-screen">
        
        <!-- Bagian Kiri: Gambar (65%) -->
        <div class="hidden lg:flex lg:w-[65%] relative overflow-hidden bg-slate-900">
            <!-- Background Image -->
            <img src="https://images.unsplash.com/photo-1519904981063-b0cf448d479e?q=80&w=1920&auto=format&fit=crop" 
                 alt="Gunung Papandayan Sunrise" 
                 class="absolute inset-0 w-full h-full object-cover">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-slate-900/10"></div>
            
            <!-- Content Kiri -->
            <div class="absolute bottom-0 left-0 p-16 w-full text-white">
                <a href="{{ url('/') }}" class="inline-block mb-6 hover:scale-105 transition-transform">
                    <img src="{{ asset('images/logo_wide.png') }}" alt="Papandayan Indonesia" class="h-12 w-auto object-contain">
                </a>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-tight leading-tight">Admin Workspace</h1>
                <p class="text-slate-300 text-lg max-w-3xl leading-relaxed font-light">
                    Kelola paket trip, jadwal pemandu, konten dokumentasi, dan testimoni klien dari satu tempat. Sistem manajemen terpusat untuk tim internal Papandayan Alam Nusantara.
                </p>
            </div>
        </div>

        <!-- Bagian Kanan: Form (35%) -->
        <div class="w-full lg:w-[35%] flex flex-col justify-center items-center px-8 sm:px-16 bg-white relative shadow-[-20px_0_30px_-15px_rgba(0,0,0,0.1)] z-10">
            <!-- Back to web link -->
            <div class="absolute top-8 left-8">
                <a href="{{ url('/') }}" class="text-sm font-bold text-slate-400 hover:text-slate-900 transition-colors flex items-center group">
                    <svg class="w-4 h-4 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Web
                </a>
            </div>
            
            <div class="max-w-md w-full w-full">
                <!-- Mobile Logo -->
                <div class="mb-10 lg:hidden p-4 bg-slate-900 rounded-xl inline-block">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo_wide.png') }}" alt="Papandayan Indonesia" class="h-10 w-auto object-contain">
                    </a>
                </div>
                
                <h2 class="text-3xl font-bold text-slate-900 mb-2 tracking-tight">Selamat Datang!</h2>
                <p class="text-slate-500 mb-10 font-medium">Silakan masuk ke akun administrator Anda.</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-1.5">Email / Username</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/20 bg-slate-50 focus:bg-white transition-all text-slate-900 placeholder-slate-400 font-medium" placeholder="admin@papandayan.id">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm font-medium" />
                    </div>

                    <!-- Password -->
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-1.5">Password</label>
                        <div class="relative">
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" class="w-full px-4 py-3.5 pr-12 rounded-xl border border-slate-200 focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/20 bg-slate-50 focus:bg-white transition-all text-slate-900 placeholder-slate-400 font-medium" placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg x-show="show" x-cloak style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm font-medium" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-yellow-500 shadow-sm focus:ring-yellow-500 focus:ring-offset-0 cursor-pointer" name="remember">
                            <span class="ml-2.5 text-sm text-slate-600 font-semibold group-hover:text-slate-900 transition-colors">Ingat Saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-bold text-yellow-600 hover:text-yellow-700 transition-colors" href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg shadow-slate-900/10 text-sm font-extrabold text-white bg-slate-900 hover:bg-slate-800 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all duration-300">
                            Masuk ke Dashboard
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="absolute bottom-8 left-0 w-full">
                <p class="text-center text-xs text-slate-400 font-bold uppercase tracking-wider">
                    &copy; {{ date('Y') }} PT Papandayan Alam Nusantara<br>All rights reserved.
                </p>
            </div>
        </div>
        
    </div>
</body>
</html>
