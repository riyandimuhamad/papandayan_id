<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'papandayan_id')) - Premium Hiking Experience</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav {
            background: rgba(15, 23, 42, 0.85); /* slate-900 with opacity */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 relative">

    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
         :class="{ 'glass-nav py-3': scrolled, 'bg-transparent py-5': !scrolled }" 
         class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center transition-transform hover:scale-105">
                        <img src="{{ asset('images/logo_wide.png') }}" alt="Papandayan Indonesia" class="h-10 md:h-12 w-auto object-contain">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ url('/') }}" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Beranda</a>
                    <a href="#about" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Tentang Kami</a>
                    <a href="#packages" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Paket Trip</a>
                    <a href="#gallery" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Galeri</a>
                    <a href="#testimonials" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Testimoni</a>
                    <a href="#articles" class="text-slate-200 hover:text-yellow-400 font-medium transition-colors">Jurnal</a>
                    
                    <a href="https://wa.me/6281234567890" target="_blank" class="px-5 py-2.5 bg-yellow-500 hover:bg-yellow-400 text-slate-900 rounded-full font-bold transition-all shadow-[0_0_15px_rgba(234,179,8,0.4)] hover:shadow-[0_0_25px_rgba(234,179,8,0.6)] hover:-translate-y-0.5">
                        Pesan Sekarang
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-yellow-400 focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="h-6 w-6" style="display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden glass-nav absolute w-full" style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-1 shadow-xl">
                <a href="{{ url('/') }}" class="block px-3 py-3 rounded-md text-base font-medium text-white hover:text-yellow-400 hover:bg-slate-800/50">Beranda</a>
                <a href="#about" class="block px-3 py-3 rounded-md text-base font-medium text-white hover:text-yellow-400 hover:bg-slate-800/50">Tentang Kami</a>
                <a href="#packages" class="block px-3 py-3 rounded-md text-base font-medium text-white hover:text-yellow-400 hover:bg-slate-800/50">Paket Trip</a>
                <a href="#gallery" class="block px-3 py-3 rounded-md text-base font-medium text-white hover:text-yellow-400 hover:bg-slate-800/50">Galeri</a>
                <a href="#testimonials" class="block px-3 py-3 rounded-md text-base font-medium text-white hover:text-yellow-400 hover:bg-slate-800/50">Testimoni</a>
                <a href="#articles" class="block px-3 py-3 rounded-md text-base font-medium text-white hover:text-yellow-400 hover:bg-slate-800/50">Jurnal</a>
                <div class="mt-4 px-3">
                    <a href="https://wa.me/6281234567890" class="block w-full text-center px-5 py-3 bg-yellow-500 text-slate-900 rounded-lg font-bold">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ url('/') }}" class="flex items-center mb-6">
                        <img src="{{ asset('images/logo_wide.png') }}" alt="Papandayan Indonesia" class="h-14 w-auto object-contain opacity-90">
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md mb-6">
                        Penyedia layanan open trip, private trip, dan pemandu profesional bersertifikat untuk petualangan Anda di Gunung Papandayan. Keselamatan dan kenyamanan Anda adalah prioritas utama kami.
                    </p>
                    <div class="flex space-x-4 text-slate-400">
                        <a href="https://instagram.com/papandayan_id" target="_blank" class="hover:text-yellow-500 transition-colors" title="Follow Instagram Kami">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase tracking-wider text-sm">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-yellow-500 transition-colors">Beranda</a></li>
                        <li><a href="#about" class="hover:text-yellow-500 transition-colors">Tentang Tim Kami</a></li>
                        <li><a href="#packages" class="hover:text-yellow-500 transition-colors">Paket Pendakian</a></li>
                        <li><a href="#gallery" class="hover:text-yellow-500 transition-colors">Galeri Perjalanan</a></li>
                        <li><a href="#testimonials" class="hover:text-yellow-500 transition-colors">Testimoni Klien</a></li>
                        <li><a href="#articles" class="hover:text-yellow-500 transition-colors">Jurnal & Panduan</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase tracking-wider text-sm">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-500 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Basecamp Gn. Papandayan, Garut, Jawa Barat</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>info@papandayan.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 flex flex-col items-center justify-center">
                <p class="text-sm text-slate-500 text-center">
                    &copy; {{ date('Y') }} papandayan_id. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
